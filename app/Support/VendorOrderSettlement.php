<?php

namespace App\Support;

use App\Models\Order;

class VendorOrderSettlement
{
    /**
     * Sum of vendor-price × qty for line items belonging to this vendor on the order.
     */
    public static function grossForVendorOnOrder(Order $order, int $vendorId): float
    {
        $order->loadMissing(['items.vendorOrders']);

        $total = 0.0;

        foreach ($order->items as $item) {
            $snapshot = self::decodePayload($item->product_snapshot);
            $vendorUnitPrice = (float) ($snapshot['vendor_price'] ?? $snapshot['price'] ?? $item->price_at_order ?? 0);
            $line = $vendorUnitPrice * (int) ($item->quantity ?? 0);

            $belongs = false;
            foreach ($item->vendorOrders ?? [] as $vo) {
                if ((int) ($vo->vendor_id ?? 0) === $vendorId) {
                    $belongs = true;
                    break;
                }
            }

            if (!$belongs && (int) ($snapshot['vendor_id'] ?? 0) === $vendorId) {
                $belongs = true;
            }

            if ($belongs) {
                $total += $line;
            }
        }

        return round($total, 2);
    }

    public static function decodePayload($payload): array
    {
        if (is_array($payload)) {
            return $payload;
        }

        $decoded = json_decode((string) $payload, true);

        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Settlement for one vendor's gross (vendor-price × qty) using order pricing_breakdown take %.
     */
    public static function forGross(Order $order, float $grossAmount): array
    {
        $pricingBreakdown = self::decodePayload($order->pricing_breakdown);
        $payoutBreakdown = is_array($pricingBreakdown['payout_breakdown'] ?? null)
            ? $pricingBreakdown['payout_breakdown']
            : [];

        $takePercent = (float) ($payoutBreakdown['vendor_take_percent']
            ?? $pricingBreakdown['vendor_take_percent']
            ?? 0);
        $takeAmount = $grossAmount > 0
            ? round($grossAmount * $takePercent / 100, 2)
            : 0.0;
        $netAmount = max(round($grossAmount - $takeAmount, 2), 0);

        return [
            'gross_amount' => round($grossAmount, 2),
            'take_percent' => round($takePercent, 2),
            'take_amount' => round($takeAmount, 2),
            'net_amount' => round($netAmount, 2),
        ];
    }
}
