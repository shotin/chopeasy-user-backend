<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductReviewController extends Controller
{
    /**
     * Store a rating for a product (authenticated users only)
     */
    public function storeRating(Request $request)
    {
        try {
            // Ensure user is authenticated
            Auth::shouldUse('api');
            if (!Auth::check()) {
                return response()->json(['error' => 'Unauthorized. Please log in to rate a product.'], 401);
            }

            // Validate request
            $request->validate([
                'product_id' => 'required|integer',
                'rating' => 'required|integer|min:1|max:5',
            ]);

            $userId = Auth::id();
            $productId = $request->product_id;

            // Check if product exists in inventory
            $response = Http::withToken(config('services.inventory.api_token'))
                ->get(config('services.inventory.url') . "/product/retail/{$productId}");

            if (!$response->successful() || isset($response->json()['error'])) {
                return response()->json(['error' => 'Product does not exist in inventory'], 422);
            }

            // Verify purchase before allowing rating
            $hasPurchased = \App\Models\OrderItem::where('product_id', $productId)
                ->whereHas('order', function ($q) use ($userId) {
                    $q->where('payment_status', 'paid')
                      ->where('user_id', $userId);
                })
                ->exists();

            if (!$hasPurchased) {
                return response()->json([
                    'error' => 'You can only rate products you have purchased.'
                ], 403);
            }

            // Create rating
            $review = ProductReview::create([
                'product_id' => $productId,
                'rating' => $request->rating,
                'name' => Auth::user()->fullname ?? 'Anonymous',
                'email' => Auth::user()->email ?? '',
                'title' => '',
                'review' => '',
                'user_id' => $userId,
            ]);

            return response()->json([
                'message' => 'Rating submitted successfully',
                'review' => $review,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Failed to submit rating', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to submit rating'], 500);
        }
    }

    /**
     * Store a review for a product (authenticated users only)
     */
    public function storeReview(Request $request)
    {
        try {
            // Ensure user is authenticated
            Auth::shouldUse('api');
            if (!Auth::check()) {
                return response()->json(['error' => 'Unauthorized. Please log in to submit a review.'], 401);
            }

            // Validate request
            $request->validate([
                'product_id' => 'required|integer',
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'title' => 'required|string|max:150',
                'review' => 'required|string',
                'rating' => 'required|integer|min:1|max:5',
            ]);

            $userId = Auth::id();
            $productId = $request->product_id;

            // Check if product exists in inventory
            $response = Http::withToken(config('services.inventory.api_token'))
                ->get(config('services.inventory.url') . "/product/retail/{$productId}");

            if (!$response->successful() || isset($response->json()['error'])) {
                return response()->json(['error' => 'Product does not exist in inventory'], 422);
            }

            // Verify purchase before allowing review
            $hasPurchased = \App\Models\OrderItem::where('product_id', $productId)
                ->whereHas('order', function ($q) use ($userId) {
                    $q->where('payment_status', 'paid')
                      ->where('user_id', $userId);
                })
                ->exists();

            if (!$hasPurchased) {
                return response()->json([
                    'error' => 'You can only review products you have purchased.'
                ], 403);
            }

            // Create review
            $review = ProductReview::create([
                'product_id' => $productId,
                'name' => $request->name,
                'email' => $request->email,
                'title' => $request->title,
                'review' => $request->review,
                'rating' => $request->rating,
                'user_id' => $userId,
            ]);

            return response()->json([
                'message' => 'Review submitted successfully',
                'review' => $review,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Failed to submit review', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to submit review'], 500);
        }
    }

    /**
     * Fetch reviews for a specific product
     */
    public function showProductReviews($productId)
    {
        try {
            $reviews = ProductReview::where('product_id', $productId)
                ->orderBy('created_at', 'desc')
                ->get();

            $averageRating = $reviews->avg('rating');

            $productDetails = $this->fetchProductsFromInventory([$productId]);
            $product = count($productDetails) > 0 ? $productDetails[0] : null;

            return response()->json([
                'product' => $product,
                'average_rating' => round($averageRating, 1),
                'total_reviews' => $reviews->count(),
                'reviews' => $reviews,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch product reviews', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to fetch product reviews'], 500);
        }
    }

    /**
     * Fetch products from inventory microservice
     */
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
                Log::error('Inventory fetch failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [];
            }

            return $response->json()['products'] ?? [];
        } catch (\Exception $e) {
            Log::error('Inventory fetch error', ['error' => $e->getMessage()]);
            return [];
        }
    }
}