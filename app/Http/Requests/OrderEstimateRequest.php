<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderEstimateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer', // Removed exists check - product is in inventory service
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.weight_kg' => 'required|numeric|min:0.1',
            'items.*.price' => 'required|numeric|min:0',
            
            'pickup_latitude' => 'required|numeric|between:-90,90',
            'pickup_longitude' => 'required|numeric|between:-180,180',
            'delivery_latitude' => 'required|numeric|between:-90,90',
            'delivery_longitude' => 'required|numeric|between:-180,180',
            
            'region_id' => 'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Order items are required',
            'items.min' => 'At least one item is required',
            'pickup_latitude.required' => 'Pickup location is required',
            'delivery_latitude.required' => 'Delivery location is required',
        ];
    }

    /**
     * Get calculated values from the request
     */
    public function getCalculatedValues(): array
    {
        $items = $this->input('items', []);
        
        $itemCount = array_sum(array_column($items, 'quantity'));
        $totalWeight = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['weight_kg'];
        }, $items));
        $vendorSubtotal = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['price'];
        }, $items));

        return [
            'item_count' => $itemCount,
            'total_weight' => round($totalWeight, 2),
            'vendor_subtotal' => round($vendorSubtotal, 2),
        ];
    }
}
