<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class WishlistController extends Controller
{
    protected function getSessionId(Request $request, &$cookie = null): ?string
    {
        $existing = $request->cookie('cart_session_id');

        if ($existing) {
            return $existing;
        }

        $sessionId = Str::uuid()->toString();
        $secure = app()->environment('production') || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
        $sameSite = $secure ? 'None' : 'Lax';

        $cookie = new SymfonyCookie(
            'cart_session_id',
            $sessionId,
            now()->addYear(),
            '/',
            null,
            $secure,
            false,
            false,
            $sameSite
        );

        return $sessionId;
    }

   public function index(Request $request)
{
    try {
        Auth::shouldUse('api');
        $userId = Auth::id();
        $sessionId = $userId ? null : $this->getSessionId($request);

        $wishlistItems = Wishlist::where(function ($q) use ($userId, $sessionId) {
            $userId ? $q->where('user_id', $userId) : $q->where('session_id', $sessionId);
        })->get();

        $wishlistMap = $wishlistItems->pluck('id', 'product_id'); 

        $productIds = $wishlistMap->keys()->toArray();
        $productDetails = $this->fetchProductsFromInventory($productIds);

        $productDetails = collect($productDetails)->map(function ($product) use ($wishlistMap) {
            $product['wishlist_id'] = $wishlistMap[$product['id']] ?? null;
            return $product;
        });

        return response()->json(['wishlist' => $productDetails]);
    } catch (Exception $e) {
        return response()->json(['error' => 'Failed to fetch wishlist'], 500);
    }
}


    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|integer',
            ]);

            $response = Http::withToken(config('services.inventory.api_token'))
                ->get(config('services.inventory.url') . "/product/retail/{$request->product_id}");

            if (!$response->successful() || isset($response->json()['error'])) {
                return response()->json(['error' => 'Product does not exist in inventory'], 422);
            }

            Auth::shouldUse('api');
            $userId = Auth::id();
            $sessionId = $userId ? null : $this->getSessionId($request);

            $exists = Wishlist::where('product_id', $request->product_id)
                ->where(function ($q) use ($userId, $sessionId) {
                    $userId ? $q->where('user_id', $userId) : $q->where('session_id', $sessionId);
                })->exists();

            if ($exists) {
                return response()->json(['message' => 'Already in wishlist'], 200);
            }

            Wishlist::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'product_id' => $request->product_id,
            ]);

            return response()->json(['message' => 'Added to wishlist'], 201);
        } catch (Exception $e) {
            // Log::error('Error adding to wishlist', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to add to wishlist'], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            Auth::shouldUse('api');
            $userId = Auth::id();
            $sessionId = $userId ? null : $this->getSessionId($request);

            $deleted = Wishlist::where('id', $id)
                ->where(function ($q) use ($userId, $sessionId) {
                    $userId ? $q->where('user_id', $userId) : $q->where('session_id', $sessionId);
                })->delete();

            if (!$deleted) {
                return response()->json(['error' => 'Wishlist item not found'], 404);
            }

            return response()->json(['message' => 'Removed from wishlist']);
        } catch (Exception $e) {
            // Log::error('Error removing from wishlist', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to remove from wishlist'], 500);
        }
    }

    protected function fetchProductsFromInventory(array $productIds)
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
                Log::error('Inventory fetch failed', ['status' => $response->status(), 'body' => $response->body()]);
                return [];
            }

            return $response->json()['products'] ?? [];
        } catch (Exception $e) {
            // Log::error('Error fetching product data from inventory', ['error' => $e->getMessage()]);
            return [];
        }
    }
}
