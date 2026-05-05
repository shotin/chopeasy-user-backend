<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentCustomerNotificationPref extends Model
{
    protected $fillable = [
        'agent_id',
        'customer_user_id',
        'notify_inactive',
        'notify_incomplete_onboarding',
    ];

    protected $casts = [
        'notify_inactive' => 'boolean',
        'notify_incomplete_onboarding' => 'boolean',
    ];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_user_id');
    }
}
