<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Notifications\VendorOrderPayoutNotification;
use App\Support\VendorOrderSettlement;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class VendorOrderPayoutNotifier
{
    /**
     * Notify vendors of order payout only when the customer has fully funded the order
     * (outright paid, or installment plan with no remaining balance).
     */
    public function notifyIfEligible(Order $order): void
    {
        if (!$order->isPaidForFulfillment()) {
            return;
        }

        if (!Schema::hasTable('notifications')) {
            return;
        }

        $order->loadMissing('items');
        $vendorTotals = [];

        foreach ($order->items as $item) {
            $snapshot = is_array($item->product_snapshot)
                ? $item->product_snapshot
                : (json_decode($item->product_snapshot ?? '[]', true) ?: []);

            $vendorId = isset($snapshot['vendor_id']) ? (int) $snapshot['vendor_id'] : null;
            if (!$vendorId) {
                continue;
            }

            $vendorUnitPrice = (float) ($snapshot['vendor_price'] ?? $snapshot['price'] ?? $item->price_at_order ?? 0);
            $vendorTotals[$vendorId] = ($vendorTotals[$vendorId] ?? 0) + $vendorUnitPrice * (int) ($item->quantity ?? 0);
        }

        foreach ($vendorTotals as $vendorId => $gross) {
            $settlement = VendorOrderSettlement::forGross($order, (float) $gross);
            $vendor = User::find($vendorId);
            if (!$vendor || $vendor->user_type !== 'vendor') {
                continue;
            }

            try {
                $vendor->notify(new VendorOrderPayoutNotification(
                    (int) $order->id,
                    (string) $order->order_number,
                    $settlement
                ));
            } catch (\Throwable $e) {
                Log::warning('Failed to send vendor payout notification', [
                    'order_id' => $order->id,
                    'vendor_id' => $vendorId,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
