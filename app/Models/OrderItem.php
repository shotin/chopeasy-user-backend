<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price_at_order', 'product_snapshot', 'variant_snapshot'];

    protected $casts = [
        'product_snapshot' => 'array',
        'variant_snapshot' => 'array',
        'price_at_order' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
