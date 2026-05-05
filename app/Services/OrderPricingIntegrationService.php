<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * Integrates pricing calculations into saved orders.
 */
class OrderPricingIntegrationService
{
    private PricingService $pricingService;

    public function __construct(?string $regionId = 'NG-DEFAULT')
    {
        $this->pricingService = new PricingService($regionId);
    }

    public function applyPricingToOrder(Order $order, array $coordinates, ?array $itemsData = null): Order
    {
        try {
            if ($itemsData !== null) {
                $itemCount = array_sum(array_column($itemsData, 'quantity'));
                $totalWeight = array_sum(array_map(function ($item) {
                    return ($item['quantity'] ?? 0) * ($item['weight_kg'] ?? 0);
                }, $itemsData));
                $customerSubtotal = array_sum(array_map(function ($item) {
                    return ($item['quantity'] ?? 0) * ($item['customer_price'] ?? $item['price'] ?? 0);
                }, $itemsData));
                $vendorSubtotal = array_sum(array_map(function ($item) {
                    $unitPrice = $item['vendor_price'] ?? $item['price'] ?? 0;
                    return ($item['quantity'] ?? 0) * $unitPrice;
                }, $itemsData));
            } else {
                $items = $order->items()->get();

                if ($items->isEmpty()) {
                    throw new Exception('Order has no items');
                }

                $itemCount = $items->sum('quantity');
                $totalWeight = $items->sum(function ($item) {
                    $snapshot = is_array($item->product_snapshot)
                        ? $item->product_snapshot
                        : (json_decode($item->product_snapshot ?? '[]', true) ?: []);

                    return $item->quantity * (float) ($snapshot['weight_kg'] ?? 0);
                });
                $customerSubtotal = $items->sum(function ($item) {
                    $snapshot = is_array($item->product_snapshot)
                        ? $item->product_snapshot
                        : (json_decode($item->product_snapshot ?? '[]', true) ?: []);

                    $unitPrice = $snapshot['customer_price'] ?? $snapshot['price'] ?? $item->price_at_order;
                    return $item->quantity * (float) $unitPrice;
                });
                $vendorSubtotal = $items->sum(function ($item) {
                    $snapshot = is_array($item->product_snapshot)
                        ? $item->product_snapshot
                        : (json_decode($item->product_snapshot ?? '[]', true) ?: []);

                    $unitPrice = $snapshot['vendor_price'] ?? $snapshot['customer_price'] ?? $snapshot['price'] ?? $item->price_at_order;
                    return $item->quantity * (float) $unitPrice;
                });
            }

            $distance = PricingService::calculateDistance(
                (float) $coordinates['pickup_lat'],
                (float) $coordinates['pickup_lng'],
                (float) $coordinates['delivery_lat'],
                (float) $coordinates['delivery_lng']
            );

            $pricing = $this->pricingService->calculateOrderPricing(
                (int) $itemCount,
                (float) $totalWeight,
                (float) $distance,
                (float) $customerSubtotal,
                (float) $vendorSubtotal
            );

            $order->update([
                'customer_product_subtotal' => $pricing['customer_product_subtotal'] ?? 0,
                'service_fee_total' => $pricing['service_fee_total'] ?? 0,
                'delivery_fee_total' => $pricing['delivery_fee_total'] ?? $pricing['total_charge'],
                'base_fee_total' => $pricing['base_fee'] ?? $pricing['base_charge'] ?? 0,
                'weight_fee_total' => $pricing['weight_fee'] ?? $pricing['weight_service_fee'] ?? 0,
                'distance_fee_total' => $pricing['distance_fee'] ?? $pricing['distance_charge_total'] ?? 0,
                'total_weight' => $totalWeight,
                'item_count' => $itemCount,
                'distance_in_km' => $distance,
                'computed_total_charge' => $pricing['delivery_fee_total'] ?? $pricing['total_charge'],
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
                'total_amount' => $pricing['payout_breakdown']['total_to_collect_from_customer'],
            ]);

            Log::info('Pricing applied to order', [
                'order_id' => $order->id,
                'delivery_fee' => $pricing['delivery_fee_total'] ?? $pricing['total_charge'],
                'service_fee' => $pricing['service_fee_total'] ?? 0,
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
                'base_charge' => $breakdown['base_fee'] ?? $breakdown['base_charge'] ?? 0,
                'weight_fee' => $breakdown['weight_fee'] ?? $breakdown['weight_service_fee'] ?? 0,
                'distance_charge' => $breakdown['distance_fee'] ?? $breakdown['distance_charge_total'] ?? 0,
                'total_delivery_charge' => $breakdown['delivery_fee_total'] ?? $breakdown['total_charge'] ?? 0,
            ],
            'order_details' => [
                'item_count' => $breakdown['item_count'],
                'total_weight_kg' => $breakdown['total_weight_kg'],
                'distance_km' => $breakdown['distance_km'],
                'product_cost' => $breakdown['customer_product_subtotal'] ?? 0,
                'vendor_items_cost' => $breakdown['vendor_subtotal'] ?? 0,
                'product_markup_total' => $breakdown['product_markup_total'] ?? 0,
            ],
            'payment_summary' => [
                'service_fee' => $breakdown['service_fee_total'] ?? $breakdown['service_charge_total'] ?? 0,
                'vendor_items_gross' => $breakdown['payout_breakdown']['vendor_gross_payout'] ?? ($breakdown['vendor_subtotal'] ?? 0),
                'vendor_take_percent' => $breakdown['payout_breakdown']['vendor_take_percent'] ?? ($breakdown['vendor_take_percent'] ?? 0),
                'vendor_take_total' => $breakdown['payout_breakdown']['vendor_take_total'] ?? 0,
                'vendor_items' => $order->vendor_payout,
                'delivery_charge' => $order->computed_total_charge,
                'total_amount' => $order->total_amount,
            ],
            'calculated_at' => $breakdown['metadata']['calculated_at'] ?? null,
        ];
    }

    public function getEarningsBreakdown(Order $order): array
    {
        return [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'total_order_value' => $order->total_amount,
            'earnings' => [
                'platform' => [
                    'amount' => $order->platform_revenue,
                    'description' => 'Platform revenue from markup, service fee, delivery margin, and vendor take',
                ],
                'rider' => [
                    'amount' => $order->rider_payout,
                    'description' => 'Rider net payout: distance fee plus rider share of weight fee (excludes order base fee and platform share of weight fee)',
                ],
                'vendor' => [
                    'amount' => $order->vendor_payout,
                    'gross_amount' => $order->pricing_breakdown['payout_breakdown']['vendor_gross_payout'] ?? $order->pricing_breakdown['vendor_subtotal'] ?? $order->vendor_payout,
                    'take_percent' => $order->pricing_breakdown['payout_breakdown']['vendor_take_percent'] ?? $order->pricing_breakdown['vendor_take_percent'] ?? 0,
                    'take_amount' => $order->pricing_breakdown['payout_breakdown']['vendor_take_total'] ?? 0,
                    'description' => 'Vendor payout after configured platform take',
                ],
            ],
            'margin_percentage' => $order->pricing_breakdown['payout_breakdown']['platform_margin_percentage'] ?? 0,
        ];
    }

    public static function buildItemsDataFromInventoryService(array $cartItems, array $productsData): array
    {
        $itemsData = [];

        foreach ($cartItems as $cartItem) {
            $productId = $cartItem['product_id'];

            if (!isset($productsData[$productId])) {
                throw new Exception("Product data not found for product_id: {$productId}");
            }

            $product = $productsData[$productId];
            $customerPrice = (float) ($product['price'] ?? 0);
            $vendorPrice = (float) ($product['vendor_price'] ?? $customerPrice);

            $itemsData[] = [
                'product_id' => $productId,
                'quantity' => $cartItem['quantity'],
                'weight_kg' => $product['weight_kg'] ?? 0,
                'price' => $customerPrice,
                'customer_price' => $customerPrice,
                'vendor_price' => $vendorPrice,
            ];
        }

        return $itemsData;
    }
}
