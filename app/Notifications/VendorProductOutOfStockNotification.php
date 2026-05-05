<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class VendorProductOutOfStockNotification extends Notification
{
    use Queueable;

    public function __construct(
        public int $vendorProductItemId,
        public string $productName,
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'inventory',
            'title' => 'Product out of stock',
            'message' => "{$this->productName} is now out of stock. Restock in your inventory so customers can order again.",
            'vendor_product_item_id' => $this->vendorProductItemId,
        ];
    }
}
