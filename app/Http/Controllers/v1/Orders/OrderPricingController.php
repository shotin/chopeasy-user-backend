<?php

namespace App\Http\Controllers\v1\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderEstimateRequest;
use App\Services\PricingService;
use Illuminate\Http\JsonResponse;
use Exception;

/**
 * Order Pricing Controller
 * Handles order estimation and pricing calculations for users
 */
class OrderPricingController extends Controller
{
    /**
     * Estimate order cost without persisting data
     * 
     * This endpoint calculates the total cost breakdown for an order
     * based on items, weight, and delivery distance.
     * 
     * @param OrderEstimateRequest $request
     * @return JsonResponse
     */
    public function estimate(OrderEstimateRequest $request): JsonResponse
    {
        try {
            // Get calculated values from request
            $calculated = $request->getCalculatedValues();
            
            // Calculate distance using Haversine formula
            $distance = PricingService::calculateDistance(
                $request->pickup_latitude,
                $request->pickup_longitude,
                $request->delivery_latitude,
                $request->delivery_longitude
            );

            // Initialize pricing service
            $regionId = $request->input('region_id', 'NG-DEFAULT');
            $pricingService = new PricingService($regionId);

            // Calculate pricing
            $pricing = $pricingService->calculateOrderPricing(
                $calculated['item_count'],
                $calculated['total_weight'],
                $distance,
                $calculated['vendor_subtotal']
            );

            return response()->json([
                'success' => true,
                'message' => 'Order estimate calculated successfully',
                'data' => [
                    'order_summary' => [
                        'item_count' => $calculated['item_count'],
                        'total_weight_kg' => $calculated['total_weight'],
                        'distance_km' => $distance,
                        'vendor_subtotal' => $calculated['vendor_subtotal'],
                    ],
                    'pricing' => $pricing,
                    'breakdown_explanation' => $this->getPricingExplanation($pricing),
                ],
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to calculate order estimate',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get a human-readable explanation of the pricing breakdown
     */
    private function getPricingExplanation(array $pricing): array
    {
        return [
            'delivery_charge_breakdown' => [
                'base_charge' => [
                    'amount' => $pricing['base_charge'],
                    'description' => 'Fixed platform charge per order',
                ],
                'service_charge' => [
                    'amount' => $pricing['service_charge_total'],
                    'calculation' => "₦{$pricing['service_charge_per_item']} × {$pricing['item_count']} items",
                    'description' => 'Charge per item in order',
                ],
                'distance_charge' => [
                    'amount' => $pricing['distance_charge_total'],
                    'calculation' => "₦{$pricing['charge_per_distance']} × {$pricing['distance_km']}km",
                    'description' => 'Cost based on delivery distance',
                ],
                'weight_service_fee' => [
                    'amount' => $pricing['weight_service_fee'],
                    'calculation' => "Base fee × {$pricing['weight_tier_multiplier']} (for {$pricing['total_weight_kg']}kg)",
                    'description' => 'Weight-based service fee',
                ],
            ],
            'total_delivery_charge' => $pricing['total_charge'],
            'payment_summary' => [
                'vendor_items_cost' => $pricing['vendor_subtotal'],
                'delivery_charge' => $pricing['total_charge'],
                'total_to_pay' => $pricing['payout_breakdown']['total_to_collect_from_customer'],
            ],
        ];
    }

    /**
     * Quick distance calculation
     * 
     * Calculates distance between two coordinates
     */
    public function calculateDistance(): JsonResponse
    {
        request()->validate([
            'pickup_latitude' => 'required|numeric|between:-90,90',
            'pickup_longitude' => 'required|numeric|between:-180,180',
            'delivery_latitude' => 'required|numeric|between:-90,90',
            'delivery_longitude' => 'required|numeric|between:-180,180',
        ]);

        $distance = PricingService::calculateDistance(
            request('pickup_latitude'),
            request('pickup_longitude'),
            request('delivery_latitude'),
            request('delivery_longitude')
        );

        return response()->json([
            'success' => true,
            'data' => [
                'distance_km' => $distance,
                'distance_meters' => round($distance * 1000, 2),
            ],
        ]);
    }

    /**
     * Get current active pricing configuration (public view)
     * Shows rates without revealing margin calculations
     */
    public function getPricingRates(): JsonResponse
    {
        try {
            $regionId = request('region_id', 'NG-DEFAULT');
            $pricingService = new PricingService($regionId);
            
            // Validate configuration
            $validation = $pricingService->validateConfiguration($regionId);
            
            if (!$validation['is_valid']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pricing configuration incomplete',
                    'issues' => $validation['issues'],
                ], 500);
            }

            $config = \App\Models\PricingConfig::getActiveConfig($regionId);
            $weightTiers = \App\Models\WeightTier::forRegion($regionId)
                ->active()
                ->orderedByWeight()
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'base_charge' => $config->base_charge,
                    'service_charge_per_item' => $config->service_charge,
                    'charge_per_km' => $config->charge_per_distance,
                    'weight_tiers' => $weightTiers->map(function ($tier) {
                        return [
                            'weight_range' => "{$tier->min_weight}kg - {$tier->max_weight}kg",
                            'service_fee' => $tier->calculateServiceFee(),
                        ];
                    }),
                    'region_id' => $regionId,
                ],
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch pricing rates',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
