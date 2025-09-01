<?php

namespace App\Repositories\ProductViewed;

interface RecentlyViewedRepositoryInterface
{
    public function addView($userId, $sessionId, $productId): void;
    public function getViews($userId, $sessionId);
    public function clearOldViews(): void;
}
