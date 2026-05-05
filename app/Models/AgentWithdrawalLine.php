<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentWithdrawalLine extends Model
{
    protected $fillable = [
        'agent_withdrawal_id',
        'agent_earning_id',
        'amount',
        'order_number',
        'earning_type',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function withdrawal(): BelongsTo
    {
        return $this->belongsTo(AgentWithdrawal::class, 'agent_withdrawal_id');
    }

    public function earning(): BelongsTo
    {
        return $this->belongsTo(AgentEarning::class, 'agent_earning_id');
    }
}
