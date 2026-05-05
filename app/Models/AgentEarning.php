<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentEarning extends Model
{
    protected $fillable = [
        'agent_id',
        'order_id',
        'earning_type',
        'referred_user_id',
        'withdrawal_id',
        'order_amount',
        'commission_percent',
        'amount',
        'status',
    ];

    protected $casts = [
        'order_amount' => 'decimal:2',
        'commission_percent' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function withdrawal(): BelongsTo
    {
        return $this->belongsTo(AgentWithdrawal::class, 'withdrawal_id');
    }

    public function referredUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
}
