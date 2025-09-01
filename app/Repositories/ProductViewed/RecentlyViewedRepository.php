<?php

namespace App\Repositories\ProductViewed;


use App\Models\RecentlyViewedProduct;
use Carbon\Carbon;

class RecentlyViewedRepository implements RecentlyViewedRepositoryInterface
{
    public function addView($userId, $sessionId, $productId): void
    {
        RecentlyViewedProduct::updateOrCreate(
            ['user_id' => $userId, 'session_id' => $sessionId, 'product_id' => $productId],
            ['viewed_at' => now()]
        );
    }

    public function getViews($userId, $sessionId)
    {
        return RecentlyViewedProduct::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->orderBy('viewed_at', 'desc')->take(10)->get();
    }

    public function clearOldViews(): void
    {
        RecentlyViewedProduct::where('viewed_at', '<', now()->subDays(30))->delete();
    }
}
