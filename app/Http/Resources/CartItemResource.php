<?php

namespace App\Http\Resources;

use App\Models\VendorProductItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    protected function stockPayloadForQuantity(int $quantity): array
    {
        $availableQuantity = max($quantity, 0);
        $isOutOfStock = $availableQuantity <= 0;
        $isLowStock = !$isOutOfStock && $availableQuantity < 5;

        return [
            'quantity' => $availableQuantity,
            'stock_status' => $isOutOfStock ? 'out_of_stock' : ($isLowStock ? 'low_stock' : 'in_stock'),
            'stock_label' => $isOutOfStock ? 'Out of stock' : ($isLowStock ? 'Low stock' : 'In stock'),
            'is_low_stock' => $isLowStock,
            'is_out_of_stock' => $isOutOfStock,
        ];
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $itemTotal = ($this->price_at_addition ?? 0) * $this->quantity;
        $productSnapshot = $this->product_snapshot;

        if (is_array($productSnapshot)) {
            $vendorProductItemId = $productSnapshot['vendor_product_item_id'] ?? null;
            $vendorId = $productSnapshot['vendor_id'] ?? null;
            $productVariantId = $productSnapshot['product_variant_id'] ?? $this->product_variant_id ?? null;
            $vendorProductItemQuery = VendorProductItem::with('vendor:id,fullname,store_name,latitude,longitude')
                ->select('id', 'price', 'vendor_price', 'vendor_id', 'product_id', 'product_variant_id', 'quantity');

            if ($vendorProductItemId) {
                $vendorProductItemQuery->whereKey($vendorProductItemId);
            } elseif ($vendorId) {
                $vendorProductItemQuery
                    ->where('vendor_id', (int) $vendorId)
                    ->where('product_id', (int) $this->product_id);

                if ($productVariantId) {
                    $vendorProductItemQuery->where('product_variant_id', (int) $productVariantId);
                } else {
                    $vendorProductItemQuery->whereNull('product_variant_id');
                }
            }

            if ($vendorProductItemId || $vendorId) {
                $vendorProductItem = $vendorProductItemQuery->latest('id')->first();

                if ($vendorProductItem) {
                    $productSnapshot['vendor_product_item_id'] = $vendorProductItem->id;
                    $productSnapshot['customer_price'] = (float) ($productSnapshot['customer_price']
                        ?? $productSnapshot['price']
                        ?? $vendorProductItem->price
                        ?? 0);
                    $productSnapshot['vendor_price'] = (float) ($vendorProductItem->vendor_price
                        ?? $vendorProductItem->price
                        ?? 0);
                    $productSnapshot['vendor_id'] = $productSnapshot['vendor_id']
                        ?? $vendorProductItem->vendor_id;
                    $productSnapshot['vendor_name'] = $productSnapshot['vendor_name']
                        ?? $vendorProductItem->vendor?->store_name
                        ?? $vendorProductItem->vendor?->fullname;
                    $productSnapshot['vendor_latitude'] = $productSnapshot['vendor_latitude']
                        ?? $vendorProductItem->vendor?->latitude;
                    $productSnapshot['vendor_longitude'] = $productSnapshot['vendor_longitude']
                        ?? $vendorProductItem->vendor?->longitude;
                    $productSnapshot['vendor'] = $productSnapshot['vendor']
                        ?? ($vendorProductItem->vendor
                            ? [
                                'id' => $vendorProductItem->vendor->id,
                                'fullname' => $vendorProductItem->vendor->fullname,
                                'store_name' => $vendorProductItem->vendor->store_name,
                                'latitude' => $vendorProductItem->vendor->latitude,
                                'longitude' => $vendorProductItem->vendor->longitude,
                            ]
                            : null);
                    $productSnapshot = array_merge(
                        $productSnapshot,
                        $this->stockPayloadForQuantity((int) ($vendorProductItem->quantity ?? 0))
                    );
                }
            }
        }

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'session_id' => $this->session_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price_at_addition' => number_format($this->price_at_addition, 2),
            'total_cost' => number_format($itemTotal, 2),
            'product_snapshot' => $productSnapshot,
            'variant_snapshot' => $this->variant_snapshot,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
