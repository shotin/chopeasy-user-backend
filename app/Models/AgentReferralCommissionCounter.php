<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentReferralCommissionCounter extends Model
{
    protected $fillable = [
        'agent_id',
        'referred_user_id',
        'referral_kind',
        'payout_count',
    ];

    protected $casts = [
        'payout_count' => 'integer',
    ];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function referredUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
}
