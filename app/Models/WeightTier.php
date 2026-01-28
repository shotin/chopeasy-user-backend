<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeightTier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'min_weight',
        'max_weight',
        'multiplier',
        'base_service_fee',
        'region_id',
        'is_active',
    ];

    protected $casts = [
        'min_weight' => 'decimal:2',
        'max_weight' => 'decimal:2',
        'multiplier' => 'integer',
        'base_service_fee' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Find the appropriate weight tier for a given weight
     */
    public static function findTierForWeight(float $weight, ?string $regionId = 'NG-DEFAULT'): ?self
    {
        return self::where('region_id', $regionId)
            ->where('is_active', true)
            ->where('min_weight', '<=', $weight)
            ->where('max_weight', '>=', $weight)
            ->orderBy('min_weight', 'asc')
            ->first();
    }

    /**
     * Calculate the service fee for this tier
     */
    public function calculateServiceFee(): float
    {
        return $this->base_service_fee * $this->multiplier;
    }

    /**
     * Relationship: Orders using this tier
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Scope: Active tiers only
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
     * Scope: Ordered by weight
     */
    public function scopeOrderedByWeight($query)
    {
        return $query->orderBy('min_weight', 'asc');
    }
}
