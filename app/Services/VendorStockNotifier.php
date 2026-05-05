<?php

namespace App\Services;

use App\Models\VendorProductItem;
use App\Models\User;
use App\Notifications\VendorProductOutOfStockNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class VendorStockNotifier
{
    public function notifyIfJustWentOutOfStock(VendorProductItem $item): void
    {
        if (!Schema::hasTable('notifications')) {
            return;
        }

        if ((int) $item->quantity > 0) {
            return;
        }

        $item->loadMissing('vendor');
        $vendor = $item->vendor instanceof User ? $item->vendor : null;
        if (!$vendor || $vendor->user_type !== 'vendor') {
            return;
        }

        $name = trim((string) ($item->display_name ?: $item->name ?: 'A product'));

        try {
            $vendor->notify(new VendorProductOutOfStockNotification(
                (int) $item->id,
                $name
            ));
        } catch (\Throwable $e) {
            Log::warning('Failed to send vendor out-of-stock notification', [
                'vendor_product_item_id' => $item->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
