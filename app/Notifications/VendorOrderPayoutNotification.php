<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class VendorOrderPayoutNotification extends Notification
{
    use Queueable;

    public function __construct(
        public int $orderId,
        public string $orderNumber,
        public array $settlement
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $g = (float) ($this->settlement['gross_amount'] ?? 0);
        $pct = (float) ($this->settlement['take_percent'] ?? 0);
        $take = (float) ($this->settlement['take_amount'] ?? 0);
        $net = (float) ($this->settlement['net_amount'] ?? 0);

        $fmt = static fn (float $n): string => number_format($n, 2, '.', ',');

        $message = $take > 0.0001
            ? "Order {$this->orderNumber}: your vendor-price subtotal is ₦{$fmt($g)}. Platform take {$fmt($pct)}% (₦{$fmt($take)}). Estimated amount credited to you after confirmation: ₦{$fmt($net)}."
            : "Order {$this->orderNumber}: your vendor-price subtotal is ₦{$fmt($g)}. Estimated amount credited to you after confirmation: ₦{$fmt($net)}.";

        return [
            'type' => 'payment',
            'title' => "New order — {$this->orderNumber}",
            'message' => $message,
            'order_id' => $this->orderId,
            'order_number' => $this->orderNumber,
            'vendor_gross_amount' => $g,
            'vendor_take_percent' => $pct,
            'vendor_take_amount' => $take,
            'vendor_net_amount' => $net,
        ];
    }
}
