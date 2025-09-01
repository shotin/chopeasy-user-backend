<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class RecentlyViewedProduct extends Model
{
    use Prunable;
    use HasFactory;

    protected $fillable = ['user_id', 'session_id', 'product_id', 'viewed_at'];
    protected $dates = ['viewed_at'];

    /**
     * Prune entries older than 30 days.
     */
    public function prunable()
    {
        return static::where('viewed_at', '<', now()->subDays(30));
    }

    // public function clearOldViews(): void
    // {
    //     RecentlyViewedProduct::where('viewed_at', '<', now()->subDays(30))->delete();
    // }
}
