<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiderPayoutRule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'min_distance',
        'max_distance',
        'zone_name',
        'flat_payout',
        'weight_limit',
        'additional_per_km',
        'additional_per_kg',
        'region_id',
        'is_active',
        'priority',
    ];

    protected $casts = [
        'min_distance' => 'decimal:2',
        'max_distance' => 'decimal:2',
        'flat_payout' => 'decimal:2',
        'weight_limit' => 'decimal:2',
        'additional_per_km' => 'decimal:2',
        'additional_per_kg' => 'decimal:2',
        'is_active' => 'boolean',
        'priority' => 'integer',
    ];

    /**
     * Find zone/distance rule for given distance (zone-based model)
     * Zone fee = flat_payout when min_distance <= distance <= max_distance
     */
    public static function findZoneForDistance(float $distance, ?string $regionId = 'NG-DEFAULT'): ?self
    {
        return self::where('region_id', $regionId)
            ->where('is_active', true)
            ->where('min_distance', '<=', $distance)
            ->where(function ($q) use ($distance) {
                $q->whereNull('max_distance')
                    ->orWhere('max_distance', '>=', $distance);
            })
            ->orderBy('min_distance', 'desc')
            ->first();
    }

    /**
     * Find the appropriate payout rule for given distance and weight (legacy + zone)
     */
    public static function findRuleForDelivery(
        float $distance,
        float $weight,
        ?string $regionId = 'NG-DEFAULT'
    ): ?self {
        $zone = self::findZoneForDistance($distance, $regionId);
        if ($zone) {
            return $zone;
        }
        return self::where('region_id', $regionId)
            ->where('is_active', true)
            ->where(function ($q) use ($distance) {
                $q->whereNull('max_distance')
                    ->orWhere('max_distance', '>=', $distance);
            })
            ->where(function ($query) use ($weight) {
                $query->whereNull('weight_limit')
                    ->orWhere('weight_limit', '>=', $weight);
            })
            ->orderBy('priority', 'asc')
            ->orderBy('max_distance', 'asc')
            ->first();
    }

    /**
     * Zone fee (distance fee charged to customer) - flat_payout in zone model
     */
    public function getZoneFee(): float
    {
        return (float) $this->flat_payout;
    }

    /**
     * Calculate the payout for given distance and weight (legacy)
     */
    public function calculatePayout(float $distance, float $weight): float
    {
        $payout = $this->flat_payout;
        if ($distance > 0 && $this->additional_per_km) {
            $payout += ($distance * $this->additional_per_km);
        }
        if ($weight > 0 && $this->additional_per_kg) {
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

    /**
     * Scope: Ordered by min distance (for zone listing)
     */
    public function scopeOrderedByMinDistance($query)
    {
        return $query->orderBy('min_distance', 'asc');
    }
}
