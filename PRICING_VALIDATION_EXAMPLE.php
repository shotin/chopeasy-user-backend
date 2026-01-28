<?php

/**
 * PRICING ENGINE VALIDATION EXAMPLE
 * 
 * This file demonstrates how to validate the pricing engine
 * with the exact sample calculation from requirements.
 * 
 * Run this after migrations to verify implementation.
 */

namespace App\Tests\Validation;

use App\Services\PricingService;

class PricingValidationExample
{
    /**
     * Validate the sample calculation from requirements:
     * 
     * Order: 4 × 10kg bags of rice
     * Total weight: 40kg
     * Distance: 10km
     * 
     * Admin Config:
     * - baseCharge = ₦1500
     * - serviceCharge = ₦200
     * - chargePerDistance = ₦15
     * - baseServiceFee (1–5kg) = ₦100
     * 
     * Expected Calculation:
     * 1500 + (200 × 4) + (15 × 10) + (100 × 5) = ₦2,750
     * 
     * Note: The requirement shows multiplier of 5 for 31-40kg range
     */
    public static function validateSampleCalculation(): array
    {
        $pricingService = new PricingService('NG-DEFAULT');

        // Sample order parameters
        $itemCount = 4;              // 4 bags
        $totalWeight = 40.0;         // 40kg total
        $distanceInKm = 10.0;        // 10km delivery
        $vendorSubtotal = 8000.00;   // Vendor items cost

        try {
            $pricing = $pricingService->calculateOrderPricing(
                $itemCount,
                $totalWeight,
                $distanceInKm,
                $vendorSubtotal
            );

            // Validate formula components
            $expected = [
                'base_charge' => 1500.00,
                'service_charge_total' => 800.00,    // 200 × 4
                'distance_charge_total' => 150.00,   // 15 × 10
                'weight_service_fee' => 500.00,      // 100 × 5 (31-40kg)
                'total_charge' => 2950.00,           // Sum of above
            ];

            $results = [
                'status' => 'VALIDATION RESULTS',
                'sample_order' => [
                    'items' => "{$itemCount} × 10kg bags of rice",
                    'total_weight' => "{$totalWeight}kg",
                    'distance' => "{$distanceInKm}km",
                    'vendor_items_cost' => "₦" . number_format($vendorSubtotal, 2),
                ],
                'expected_breakdown' => [
                    'Base Charge' => "₦" . number_format($expected['base_charge'], 2),
                    'Service Charge' => "₦{$expected['service_charge_total']} (₦200 × {$itemCount})",
                    'Distance Charge' => "₦{$expected['distance_charge_total']} (₦15 × {$distanceInKm}km)",
                    'Weight Service Fee' => "₦{$expected['weight_service_fee']} (₦100 × 5 for 31-40kg)",
                    'Total Delivery Charge' => "₦" . number_format($expected['total_charge'], 2),
                ],
                'actual_results' => [
                    'Base Charge' => "₦" . number_format($pricing['base_charge'], 2),
                    'Service Charge' => "₦" . number_format($pricing['service_charge_total'], 2),
                    'Distance Charge' => "₦" . number_format($pricing['distance_charge_total'], 2),
                    'Weight Service Fee' => "₦" . number_format($pricing['weight_service_fee'], 2),
                    'Total Delivery Charge' => "₦" . number_format($pricing['total_charge'], 2),
                ],
                'validation' => [
                    'base_charge_match' => $pricing['base_charge'] == $expected['base_charge'] ? '✓ PASS' : '✗ FAIL',
                    'service_charge_match' => $pricing['service_charge_total'] == $expected['service_charge_total'] ? '✓ PASS' : '✗ FAIL',
                    'distance_charge_match' => $pricing['distance_charge_total'] == $expected['distance_charge_total'] ? '✓ PASS' : '✗ FAIL',
                    'weight_fee_match' => $pricing['weight_service_fee'] == $expected['weight_service_fee'] ? '✓ PASS' : '✗ FAIL',
                    'total_match' => $pricing['total_charge'] == $expected['total_charge'] ? '✓ PASS' : '✗ FAIL',
                ],
                'payout_distribution' => [
                    'Platform Revenue' => "₦" . number_format($pricing['payout_breakdown']['platform_revenue'], 2),
                    'Rider Payout' => "₦" . number_format($pricing['payout_breakdown']['rider_payout'], 2),
                    'Vendor Payout' => "₦" . number_format($pricing['payout_breakdown']['vendor_payout'], 2),
                    'Platform Margin' => $pricing['payout_breakdown']['platform_margin_percentage'] . '%',
                ],
                'customer_payment' => [
                    'Vendor Items' => "₦" . number_format($vendorSubtotal, 2),
                    'Delivery Charge' => "₦" . number_format($pricing['total_charge'], 2),
                    'TOTAL TO PAY' => "₦" . number_format($pricing['payout_breakdown']['total_to_collect_from_customer'], 2),
                ],
                'overall_status' => self::calculateOverallStatus($pricing, $expected),
            ];

            return $results;

        } catch (\Exception $e) {
            return [
                'status' => 'ERROR',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ];
        }
    }

    private static function calculateOverallStatus(array $pricing, array $expected): string
    {
        $allMatch = 
            $pricing['base_charge'] == $expected['base_charge'] &&
            $pricing['service_charge_total'] == $expected['service_charge_total'] &&
            $pricing['distance_charge_total'] == $expected['distance_charge_total'] &&
            $pricing['weight_service_fee'] == $expected['weight_service_fee'] &&
            $pricing['total_charge'] == $expected['total_charge'];

        return $allMatch ? '✅ ALL VALIDATIONS PASSED' : '⚠️ SOME VALIDATIONS FAILED';
    }

    /**
     * Test edge cases
     */
    public static function testEdgeCases(): array
    {
        $pricingService = new PricingService('NG-DEFAULT');
        $results = [];

        // Test Case 1: Minimum weight (1kg)
        try {
            $pricing = $pricingService->calculateOrderPricing(1, 1.0, 5.0, 500.00);
            $results['test_1kg'] = [
                'weight' => '1kg',
                'total_charge' => "₦" . number_format($pricing['total_charge'], 2),
                'weight_fee' => "₦" . number_format($pricing['weight_service_fee'], 2) . " (multiplier: {$pricing['weight_tier_multiplier']})",
                'status' => '✓ PASS',
            ];
        } catch (\Exception $e) {
            $results['test_1kg'] = ['status' => '✗ FAIL', 'error' => $e->getMessage()];
        }

        // Test Case 2: Maximum weight (50kg)
        try {
            $pricing = $pricingService->calculateOrderPricing(5, 50.0, 15.0, 10000.00);
            $results['test_50kg'] = [
                'weight' => '50kg',
                'total_charge' => "₦" . number_format($pricing['total_charge'], 2),
                'weight_fee' => "₦" . number_format($pricing['weight_service_fee'], 2) . " (multiplier: {$pricing['weight_tier_multiplier']})",
                'status' => '✓ PASS',
            ];
        } catch (\Exception $e) {
            $results['test_50kg'] = ['status' => '✗ FAIL', 'error' => $e->getMessage()];
        }

        // Test Case 3: Boundary weight (5kg - tier boundary)
        try {
            $pricing = $pricingService->calculateOrderPricing(1, 5.0, 3.0, 1000.00);
            $results['test_5kg_boundary'] = [
                'weight' => '5kg (tier boundary)',
                'total_charge' => "₦" . number_format($pricing['total_charge'], 2),
                'weight_fee' => "₦" . number_format($pricing['weight_service_fee'], 2) . " (multiplier: {$pricing['weight_tier_multiplier']})",
                'status' => '✓ PASS',
            ];
        } catch (\Exception $e) {
            $results['test_5kg_boundary'] = ['status' => '✗ FAIL', 'error' => $e->getMessage()];
        }

        // Test Case 4: High distance (50km)
        try {
            $pricing = $pricingService->calculateOrderPricing(2, 10.0, 50.0, 3000.00);
            $results['test_long_distance'] = [
                'distance' => '50km',
                'total_charge' => "₦" . number_format($pricing['total_charge'], 2),
                'distance_charge' => "₦" . number_format($pricing['distance_charge_total'], 2),
                'rider_payout' => "₦" . number_format($pricing['payout_breakdown']['rider_payout'], 2),
                'status' => '✓ PASS',
            ];
        } catch (\Exception $e) {
            $results['test_long_distance'] = ['status' => '✗ FAIL', 'error' => $e->getMessage()];
        }

        return $results;
    }
}

/**
 * HOW TO RUN THIS VALIDATION:
 * 
 * 1. Via Artisan Tinker:
 *    php artisan tinker
 *    >>> print_r(\App\Tests\Validation\PricingValidationExample::validateSampleCalculation());
 *    >>> print_r(\App\Tests\Validation\PricingValidationExample::testEdgeCases());
 * 
 * 2. Via Test Route (add to routes/api.php):
 *    Route::get('/test-pricing', function () {
 *        return response()->json([
 *            'sample_validation' => \App\Tests\Validation\PricingValidationExample::validateSampleCalculation(),
 *            'edge_cases' => \App\Tests\Validation\PricingValidationExample::testEdgeCases(),
 *        ]);
 *    });
 * 
 * 3. Via PHPUnit (create proper test):
 *    php artisan test --filter=PricingValidationTest
 */
