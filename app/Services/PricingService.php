<?php

namespace App\Services;

use App\Models\PricingConfig;
use App\Models\WeightTier;
use App\Models\RiderPayoutRule;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * PricingService - Core pricing calculation engine
 * 
 * Implements the formula:
 * TotalCharge = baseCharge + (serviceCharge × itemCount) + (chargePerDistance × distanceInKm) + baseServiceFee(weightRange)
 */
class PricingService
{
    private ?PricingConfig $pricingConfig = null;
    private ?WeightTier $weightTier = null;
    private ?RiderPayoutRule $riderPayoutRule = null;
    private string $regionId;

    /**
     * Initialize the pricing service
     */
    public function __construct(?string $regionId = 'NG-DEFAULT')
    {
        $this->regionId = $regionId;
    }

    /**
     * Calculate the total charge for an order
     * 
     * @param int $itemCount Total quantity of items
     * @param float $totalWeight Total weight in kg
     * @param float $distanceInKm Distance in kilometers
     * @param float|null $vendorSubtotal Vendor's subtotal (items cost)
     * @return array Complete pricing breakdown
     * @throws Exception if configuration is missing
     */
    public function calculateOrderPricing(
        int $itemCount,
        float $totalWeight,
        float $distanceInKm,
        ?float $vendorSubtotal = 0
    ): array {
        // Load active pricing configuration
        $this->loadPricingConfig();
        
        // Find appropriate weight tier
        $this->loadWeightTier($totalWeight);
        
        // Find rider payout rule
        $this->loadRiderPayoutRule($distanceInKm, $totalWeight);

        // Execute the pricing formula
        $breakdown = $this->executeFormula($itemCount, $totalWeight, $distanceInKm, $vendorSubtotal);

        // Calculate payouts
        $breakdown['payout_breakdown'] = $this->calculatePayouts($breakdown, $vendorSubtotal);

        // Add metadata
        $breakdown['metadata'] = $this->getMetadata();

        return $breakdown;
    }

    /**
     * Execute the core pricing formula
     */
    private function executeFormula(
        int $itemCount,
        float $totalWeight,
        float $distanceInKm,
        float $vendorSubtotal
    ): array {
        // TotalCharge = baseCharge + (serviceCharge × itemCount) + (chargePerDistance × distanceInKm) + baseServiceFee(weightRange)
        
        $baseCharge = $this->pricingConfig->base_charge;
        $serviceChargeTotal = $this->pricingConfig->service_charge * $itemCount;
        $distanceChargeTotal = $this->pricingConfig->charge_per_distance * $distanceInKm;
        $weightServiceFee = $this->weightTier->calculateServiceFee();

        $totalCharge = $baseCharge + $serviceChargeTotal + $distanceChargeTotal + $weightServiceFee;

        return [
            'base_charge' => round($baseCharge, 2),
            'service_charge_per_item' => round($this->pricingConfig->service_charge, 2),
            'service_charge_total' => round($serviceChargeTotal, 2),
            'charge_per_distance' => round($this->pricingConfig->charge_per_distance, 2),
            'distance_charge_total' => round($distanceChargeTotal, 2),
            'weight_service_fee' => round($weightServiceFee, 2),
            'weight_tier_multiplier' => $this->weightTier->multiplier,
            'total_charge' => round($totalCharge, 2),
            'item_count' => $itemCount,
            'total_weight_kg' => $totalWeight,
            'distance_km' => $distanceInKm,
            'vendor_subtotal' => round($vendorSubtotal, 2),
        ];
    }

    /**
     * Calculate payout distribution
     */
    private function calculatePayouts(array $breakdown, float $vendorSubtotal): array
    {
        $totalCharge = $breakdown['total_charge'];
        
        // Calculate rider payout
        $riderPayout = $this->riderPayoutRule 
            ? $this->riderPayoutRule->calculatePayout($breakdown['distance_km'], $breakdown['total_weight_kg'])
            : 0;

        // Vendor gets their items cost
        $vendorPayout = $vendorSubtotal;

        // Platform revenue = Total charge - Rider payout
        // (Vendor is paid separately from vendor's subtotal, not from delivery charge)
        $platformRevenue = $totalCharge - $riderPayout;

        // Calculate margin percentage
        $marginPercentage = $totalCharge > 0 
            ? round(($platformRevenue / $totalCharge) * 100, 2)
            : 0;

        return [
            'rider_payout' => round($riderPayout, 2),
            'vendor_payout' => round($vendorPayout, 2),
            'platform_revenue' => round($platformRevenue, 2),
            'platform_margin_percentage' => $marginPercentage,
            'total_to_collect_from_customer' => round($totalCharge + $vendorSubtotal, 2),
        ];
    }

    /**
     * Load active pricing configuration
     */
    private function loadPricingConfig(): void
    {
        $this->pricingConfig = PricingConfig::getActiveConfig($this->regionId);

        if (!$this->pricingConfig) {
            Log::error("No active pricing config found for region: {$this->regionId}");
            throw new Exception("Pricing configuration not available for region: {$this->regionId}");
        }
    }

    /**
     * Load weight tier for given weight
     */
    private function loadWeightTier(float $weight): void
    {
        $this->weightTier = WeightTier::findTierForWeight($weight, $this->regionId);

        if (!$this->weightTier) {
            Log::error("No weight tier found for weight: {$weight}kg in region: {$this->regionId}");
            throw new Exception("Weight tier not configured for {$weight}kg. Please configure weight tiers.");
        }
    }

    /**
     * Load rider payout rule
     */
    private function loadRiderPayoutRule(float $distance, float $weight): void
    {
        $this->riderPayoutRule = RiderPayoutRule::findRuleForDelivery($distance, $weight, $this->regionId);

        if (!$this->riderPayoutRule) {
            Log::warning("No rider payout rule found for distance: {$distance}km, weight: {$weight}kg");
            // Don't throw exception - we can still calculate order total
        }
    }

    /**
     * Get metadata about the pricing calculation
     */
    private function getMetadata(): array
    {
        return [
            'pricing_config_id' => $this->pricingConfig->id,
            'pricing_config_name' => $this->pricingConfig->name,
            'weight_tier_id' => $this->weightTier->id,
            'weight_tier_range' => "{$this->weightTier->min_weight}kg - {$this->weightTier->max_weight}kg",
            'rider_payout_rule_id' => $this->riderPayoutRule?->id,
            'region_id' => $this->regionId,
            'calculated_at' => now()->toIso8601String(),
        ];
    }

    /**
     * Preview pricing for admin dashboard
     */
    public function previewPricing(array $scenarios): array
    {
        $results = [];

        foreach ($scenarios as $scenario) {
            try {
                $results[] = [
                    'scenario' => $scenario,
                    'pricing' => $this->calculateOrderPricing(
                        $scenario['item_count'],
                        $scenario['total_weight'],
                        $scenario['distance_km'],
                        $scenario['vendor_subtotal'] ?? 0
                    ),
                ];
            } catch (Exception $e) {
                $results[] = [
                    'scenario' => $scenario,
                    'error' => $e->getMessage(),
                ];
            }
        }

        return $results;
    }

    /**
     * Validate pricing configuration completeness
     */
    public function validateConfiguration(?string $regionId = null): array
    {
        $regionId = $regionId ?? $this->regionId;
        $issues = [];

        // Check pricing config
        $config = PricingConfig::getActiveConfig($regionId);
        if (!$config) {
            $issues[] = "No active pricing configuration found for region: {$regionId}";
        }

        // Check weight tiers
        $tiers = WeightTier::forRegion($regionId)->active()->orderedByWeight()->get();
        if ($tiers->isEmpty()) {
            $issues[] = "No weight tiers configured for region: {$regionId}";
        } else {
            // Check for gaps in weight coverage
            $maxWeight = $tiers->max('max_weight');
            if ($maxWeight < 50) {
                $issues[] = "Weight tiers only cover up to {$maxWeight}kg. Consider extending to 50kg.";
            }
        }

        // Check rider payout rules
        $rules = RiderPayoutRule::forRegion($regionId)->active()->get();
        if ($rules->isEmpty()) {
            $issues[] = "No rider payout rules configured for region: {$regionId}";
        }

        return [
            'is_valid' => empty($issues),
            'issues' => $issues,
            'region_id' => $regionId,
        ];
    }

    /**
     * Calculate distance between two coordinates (Haversine formula)
     */
    public static function calculateDistance(
        float $lat1,
        float $lon1,
        float $lat2,
        float $lon2
    ): float {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2);
    }
}
