<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * OrderPricingIntegrationService
 * 
 * Integrates pricing calculations into order creation flow
 * This service should be called during checkout to apply pricing
 */
class OrderPricingIntegrationService
{
    private PricingService $pricingService;

    public function __construct(?string $regionId = 'NG-DEFAULT')
    {
        $this->pricingService = new PricingService($regionId);
    }

    /**
     * Apply pricing to an order
     * Call this method during order creation/checkout
     * 
     * @param Order $order
     * @param array $coordinates ['pickup_lat', 'pickup_lng', 'delivery_lat', 'delivery_lng']
     * @param array|null $itemsData Optional array with weight data if products are in separate service
     *                              Format: [['product_id' => 1, 'quantity' => 2, 'weight_kg' => 10, 'price' => 2000], ...]
     * @return Order Updated order with pricing
     */
    public function applyPricingToOrder(Order $order, array $coordinates, ?array $itemsData = null): Order
    {
        try {
            // If items data provided (microservices scenario), use it
            if ($itemsData !== null) {
                $itemCount = array_sum(array_column($itemsData, 'quantity'));
                $totalWeight = array_sum(array_map(function ($item) {
                    return $item['quantity'] * ($item['weight_kg'] ?? 0);
                }, $itemsData));
                $vendorSubtotal = array_sum(array_map(function ($item) {
                    return $item['quantity'] * ($item['price'] ?? 0);
                }, $itemsData));
            } else {
                // Traditional approach - get from database
                $items = $order->items()->get();

                if ($items->isEmpty()) {
                    throw new Exception('Order has no items');
                }

                // Calculate totals from items
                $itemCount = $items->sum('quantity');
                
                // Try to get weight from product_snapshot if products are in separate service
                $totalWeight = $items->sum(function ($item) {
                    // Check product_snapshot first (if stored during order creation)
                    if (isset($item->product_snapshot['weight_kg'])) {
                        return $item->quantity * $item->product_snapshot['weight_kg'];
                    }
                    
                    // Fallback: check if product relationship exists (monolith setup)
                    if ($item->relationLoaded('product') && $item->product) {
                        return $item->quantity * ($item->product->weight_kg ?? 0);
                    }
                    
                    // No weight data available
                    throw new Exception("Weight data not available for item ID {$item->id}. Please provide itemsData parameter or ensure product_snapshot contains weight_kg.");
                });
                
                $vendorSubtotal = $items->sum(function ($item) {
                    return $item->quantity * $item->price;
                });
            }

            // Calculate distance
            $distance = PricingService::calculateDistance(
                $coordinates['pickup_lat'],
                $coordinates['pickup_lng'],
                $coordinates['delivery_lat'],
                $coordinates['delivery_lng']
            );

            // Calculate pricing
            $pricing = $this->pricingService->calculateOrderPricing(
                $itemCount,
                $totalWeight,
                $distance,
                $vendorSubtotal
            );

            // Update order with pricing data
            $order->update([
                'total_weight' => $totalWeight,
                'item_count' => $itemCount,
                'distance_in_km' => $distance,
                'computed_total_charge' => $pricing['total_charge'],
                'platform_revenue' => $pricing['payout_breakdown']['platform_revenue'],
                'rider_payout' => $pricing['payout_breakdown']['rider_payout'],
                'vendor_payout' => $pricing['payout_breakdown']['vendor_payout'],
                'pricing_config_id' => $pricing['metadata']['pricing_config_id'],
                'weight_tier_id' => $pricing['metadata']['weight_tier_id'],
                'pricing_breakdown' => $pricing,
                'pickup_latitude' => $coordinates['pickup_lat'],
                'pickup_longitude' => $coordinates['pickup_lng'],
                'delivery_latitude' => $coordinates['delivery_lat'],
                'delivery_longitude' => $coordinates['delivery_lng'],
                // Update total_amount to include delivery charge + vendor subtotal
                'total_amount' => $pricing['payout_breakdown']['total_to_collect_from_customer'],
            ]);

            Log::info('Pricing applied to order', [
                'order_id' => $order->id,
                'total_charge' => $pricing['total_charge'],
                'platform_revenue' => $pricing['payout_breakdown']['platform_revenue'],
            ]);

            return $order->fresh();

        } catch (Exception $e) {
            Log::error('Failed to apply pricing to order', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Recalculate pricing for an existing order
     * Useful for order modifications or repricing
     */
    public function recalculatePricing(Order $order): Order
    {
        if (!$order->pickup_latitude || !$order->delivery_latitude) {
            throw new Exception('Order missing coordinate data');
        }

        return $this->applyPricingToOrder($order, [
            'pickup_lat' => $order->pickup_latitude,
            'pickup_lng' => $order->pickup_longitude,
            'delivery_lat' => $order->delivery_latitude,
            'delivery_lng' => $order->delivery_longitude,
        ]);
    }

    /**
     * Get pricing summary for display
     */
    public function getPricingSummary(Order $order): array
    {
        if (!$order->pricing_breakdown) {
            return [
                'has_pricing' => false,
                'message' => 'Pricing not calculated for this order',
            ];
        }

        $breakdown = $order->pricing_breakdown;

        return [
            'has_pricing' => true,
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'delivery_charges' => [
                'base_charge' => $breakdown['base_charge'],
                'service_charge' => $breakdown['service_charge_total'],
                'distance_charge' => $breakdown['distance_charge_total'],
                'weight_service_fee' => $breakdown['weight_service_fee'],
                'total_delivery_charge' => $breakdown['total_charge'],
            ],
            'order_details' => [
                'item_count' => $breakdown['item_count'],
                'total_weight_kg' => $breakdown['total_weight_kg'],
                'distance_km' => $breakdown['distance_km'],
                'vendor_items_cost' => $breakdown['vendor_subtotal'],
            ],
            'payment_summary' => [
                'vendor_items' => $order->vendor_payout,
                'delivery_charge' => $order->computed_total_charge,
                'total_amount' => $order->total_amount,
            ],
            'calculated_at' => $breakdown['metadata']['calculated_at'] ?? null,
        ];
    }

    /**
     * Calculate expected earnings for different parties
     */
    public function getEarningsBreakdown(Order $order): array
    {
        return [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'total_order_value' => $order->total_amount,
            'earnings' => [
                'platform' => [
                    'amount' => $order->platform_revenue,
                    'description' => 'Platform margin from delivery charges',
                ],
                'rider' => [
                    'amount' => $order->rider_payout,
                    'description' => 'Rider delivery payout',
                ],
                'vendor' => [
                    'amount' => $order->vendor_payout,
                    'description' => 'Vendor items payout',
                ],
            ],
            'margin_percentage' => $order->pricing_breakdown['payout_breakdown']['platform_margin_percentage'] ?? 0,
        ];
    }

    /**
     * Helper: Build items data array from cart/inventory service
     * Use this when products are in a separate microservice
     * 
     * @param array $cartItems Array of cart items from your system
     * @param array $productsData Product details fetched from inventory service
     * @return array Formatted items ready for pricing calculation
     */
    public static function buildItemsDataFromInventoryService(array $cartItems, array $productsData): array
    {
        $itemsData = [];
        
        foreach ($cartItems as $cartItem) {
            $productId = $cartItem['product_id'];
            
            if (!isset($productsData[$productId])) {
                throw new Exception("Product data not found for product_id: {$productId}");
            }
            
            $product = $productsData[$productId];
            
            $itemsData[] = [
                'product_id' => $productId,
                'quantity' => $cartItem['quantity'],
                'weight_kg' => $product['weight_kg'] ?? 0,
                'price' => $product['price'] ?? 0,
            ];
        }
        
        return $itemsData;
    }
}
