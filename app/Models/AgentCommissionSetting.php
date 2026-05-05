<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentCommissionSetting extends Model
{
    protected $fillable = [
        'customer_percent',
        'vendor_percent',
        'rider_percent',
        'max_vendor_rider_payout_commissions',
    ];

    protected $casts = [
        'customer_percent' => 'decimal:2',
        'vendor_percent' => 'decimal:2',
        'rider_percent' => 'decimal:2',
        'max_vendor_rider_payout_commissions' => 'integer',
    ];
}
