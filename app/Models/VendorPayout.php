<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorPayout extends Model
{
    protected $fillable = [
        'vendor_id',
        'order_id',
        'amount',
        'status',
        'bank_name',
        'bank_code',
        'account_number',
        'account_name',
        'recipient_code',
        'transfer_code',
        'transfer_reference',
        'failure_reason',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
