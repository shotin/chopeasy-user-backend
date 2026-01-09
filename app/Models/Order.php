<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'session_id', 'order_number', 'total_amount', 'status', 'shipping_address_id', 'shipping_address_snapshot', 'payment_status', 'payment_type', 'amount_paid', 'remaining_amount', 'next_due_date', 'vendor_order_code', 'accepted_by', 'delivery_address'];

    protected $casts = [
        'shipping_address_snapshot' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class)->latest();
    }

    public function vendorOrders()
    {
        return $this->hasManyThrough(VendorOrder::class, OrderItem::class, 'order_id', 'order_item_id');
    }
}
