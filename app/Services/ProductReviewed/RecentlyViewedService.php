<?php

namespace App\Services\ProductReviewed;

use App\Models\RecentlyViewedProduct;
use App\Repositories\ProductViewed\RecentlyViewedRepositoryInterface;
use Illuminate\Support\Facades\Http;

class RecentlyViewedService
{
    protected $repository;

    public function __construct(RecentlyViewedRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function addProductView($userId, $sessionId, $productId)
    {
        $this->repository->addView($userId, $sessionId, $productId);
    }

    public function getViewedProducts($userId, $sessionId)
    {
        return $this->repository->getViews($userId, $sessionId);
    }

    public function checkProductExists(int $productId): bool
    {
        try {
            $response = Http::withToken(config('services.inventory.api_token'))
                ->get(config('services.inventory.url') . "/product/retail/{$productId}");

            return $response->successful() && isset($response->json()['id']);
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function getViewedProductIds(?int $userId, ?string $sessionId): array
    {
        $query = RecentlyViewedProduct::query()
            ->orderByDesc('viewed_at');

        if ($userId) {
            $query->where('user_id', $userId);
        } elseif ($sessionId) {
            $query->where('session_id', $sessionId);
        } else {
            return [];
        }

        return $query->pluck('product_id')->unique()->toArray();
    }

    public function fetchProductsFromInventory(array $productIds): array
    {
        try {
            if (empty($productIds)) {
                return [];
            }

            $response = Http::withToken(config('services.inventory.api_token'))
                ->post(config('services.inventory.url') . '/product/wishlist', [
                    'product_ids' => $productIds,
                ]);

            if (!$response->successful()) {
                // \Log::error('Failed to fetch inventory products', [
                //     'status' => $response->status(),
                //     'body' => $response->body()
                // ]);
                return [];
            }

            return $response->json()['products'] ?? [];
        } catch (\Throwable $e) {
            // \Log::error('Exception in fetching inventory products', ['error' => $e->getMessage()]);
            return [];
        }
    }

    public function mergeSessionViewsToUser(string $sessionId, int $userId): void
    {
        $sessionViews = RecentlyViewedProduct::where('session_id', $sessionId)->get();

        foreach ($sessionViews as $view) {
            $exists = RecentlyViewedProduct::where('user_id', $userId)
                ->where('product_id', $view->product_id)
                ->exists();

            if (!$exists) {
                $view->update([
                    'user_id' => $userId,
                    'session_id' => null,
                ]);
            } else {
                $view->delete();
            }
        }
    }
}
