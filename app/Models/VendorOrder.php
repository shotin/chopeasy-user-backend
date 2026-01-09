<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorOrder extends Model
{
    use HasFactory;

    protected $table = 'vendor_orders';

    protected $fillable = [
        'vendor_id',
        'order_item_id',
        'vendor_order_code',
        'status',
    ];

    /**
     * Belongs to an Order
     */
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }

    public function order()
    {
        return $this->hasOneThrough(Order::class, OrderItem::class, 'id', 'id', 'order_item_id', 'order_id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
