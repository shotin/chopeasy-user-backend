<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $itemTotal = ($this->price_at_addition ?? 0) * $this->quantity;

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'session_id' => $this->session_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price_at_addition' => number_format($this->price_at_addition, 2),
            'total_cost' => number_format($itemTotal, 2),
            'product_snapshot' => $this->product_snapshot,
            'variant_snapshot' => $this->variant_snapshot,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
