<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiderPayoutRule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'max_distance',
        'flat_payout',
        'weight_limit',
        'additional_per_km',
        'additional_per_kg',
        'region_id',
        'is_active',
        'priority',
    ];

    protected $casts = [
        'max_distance' => 'decimal:2',
        'flat_payout' => 'decimal:2',
        'weight_limit' => 'decimal:2',
        'additional_per_km' => 'decimal:2',
        'additional_per_kg' => 'decimal:2',
        'is_active' => 'boolean',
        'priority' => 'integer',
    ];

    /**
     * Find the appropriate payout rule for given distance and weight
     */
    public static function findRuleForDelivery(
        float $distance,
        float $weight,
        ?string $regionId = 'NG-DEFAULT'
    ): ?self {
        return self::where('region_id', $regionId)
            ->where('is_active', true)
            ->where('max_distance', '>=', $distance)
            ->where(function ($query) use ($weight) {
                $query->whereNull('weight_limit')
                    ->orWhere('weight_limit', '>=', $weight);
            })
            ->orderBy('priority', 'asc')
            ->orderBy('max_distance', 'asc')
            ->first();
    }

    /**
     * Calculate the payout for given distance and weight
     */
    public function calculatePayout(float $distance, float $weight): float
    {
        $payout = $this->flat_payout;

        // Add additional charges if applicable
        if ($distance > 0) {
            $payout += ($distance * $this->additional_per_km);
        }

        if ($weight > 0) {
            $payout += ($weight * $this->additional_per_kg);
        }

        return round($payout, 2);
    }

    /**
     * Scope: Active rules only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: By region
     */
    public function scopeForRegion($query, ?string $regionId)
    {
        return $query->where('region_id', $regionId);
    }

    /**
     * Scope: Ordered by priority
     */
    public function scopeOrderedByPriority($query)
    {
        return $query->orderBy('priority', 'asc');
    }
}
