<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\User;
use App\Models\VendorProductItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TopRatedController extends Controller
{
    /**
     * Get top rated stores/vendors
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function topRatedStores(Request $request)
    {
        try {
            $limit = $request->query('limit', 5);
            $limit = min($limit, 50); // Max 50 stores

            // First, get all vendors
            $vendors = User::where('user_type', 'vendor')
                ->where('is_active', true)
                ->where('is_verified', true)
                ->get();

            if ($vendors->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'No vendors found',
                    'data' => [],
                    'total' => 0,
                ], 200);
            }

            // Get vendor IDs
            $vendorIds = $vendors->pluck('id')->toArray();

            // Get product IDs for each vendor from vendor_product_items
            $vendorProducts = VendorProductItem::whereIn('vendor_id', $vendorIds)
                ->whereNotNull('product_id')
                ->select('vendor_id', 'product_id')
                ->get()
                ->groupBy('vendor_id');

            // Get all product reviews grouped by product_id
            $productRatings = DB::table('product_reviews')
                ->select('product_id', DB::raw('AVG(rating) as avg_rating'), DB::raw('COUNT(*) as review_count'))
                ->groupBy('product_id')
                ->get()
                ->keyBy('product_id');

            // Calculate ratings for each vendor
            $vendorRatings = [];
            foreach ($vendors as $vendor) {
                $vendorProductIds = $vendorProducts->get($vendor->id, collect())->pluck('product_id')->toArray();
                
                if (empty($vendorProductIds)) {
                    continue; // Skip vendors with no products
                }

                $ratings = [];
                $totalReviews = 0;
                
                foreach ($vendorProductIds as $productId) {
                    if (isset($productRatings[$productId])) {
                        $ratings[] = (float) $productRatings[$productId]->avg_rating;
                        $totalReviews += (int) $productRatings[$productId]->review_count;
                    }
                }

                if (!empty($ratings)) {
                    $averageRating = array_sum($ratings) / count($ratings);
                    $vendorRatings[] = [
                        'vendor' => $vendor,
                        'average_rating' => $averageRating,
                        'total_reviews' => $totalReviews,
                        'total_products' => count($vendorProductIds),
                    ];
                }
            }

            // Sort by average rating, then by total reviews
            usort($vendorRatings, function ($a, $b) {
                if ($a['average_rating'] == $b['average_rating']) {
                    return $b['total_reviews'] - $a['total_reviews'];
                }
                return $b['average_rating'] <=> $a['average_rating'];
            });

            // Limit results
            $vendorRatings = array_slice($vendorRatings, 0, $limit);

            // Format the response
            $formattedStores = collect($vendorRatings)->map(function ($item) {
                $store = $item['vendor'];
                return [
                    'id' => $store->id,
                    'name' => $store->store_name ?? $store->fullname,
                    'fullname' => $store->fullname,
                    'store_image' => $store->store_image,
                    'address' => $store->address,
                    'state' => $store->state,
                    'country' => $store->country,
                    'latitude' => $store->latitude,
                    'longitude' => $store->longitude,
                    'is_verified' => (bool) $store->is_verified,
                    'average_rating' => round($item['average_rating'], 2),
                    'total_reviews' => $item['total_reviews'],
                    'total_products' => $item['total_products'],
                    'joined_at' => $store->created_at ? $store->created_at->format('Y-m-d H:i:s') : null,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Top rated stores retrieved successfully',
                'data' => $formattedStores->values(),
                'total' => $formattedStores->count(),
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to fetch top rated stores', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch top rated stores',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get top rated products
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function topRatedProducts(Request $request)
    {
        try {
            $limit = $request->query('limit', 5);
            $limit = min($limit, 50); // Max 50 products
            $minReviews = $request->query('min_reviews', 1); // Minimum reviews to be considered

            // Get product IDs with their ratings from product_reviews table
            $productRatings = DB::table('product_reviews')
                ->select([
                    'product_id',
                    DB::raw('AVG(rating) as average_rating'),
                    DB::raw('COUNT(*) as total_reviews'),
                ])
                ->groupBy('product_id')
                ->havingRaw('COUNT(*) >= ?', [$minReviews])
                ->orderByDesc(DB::raw('AVG(rating)'))
                ->orderByDesc(DB::raw('COUNT(*)'))
                ->limit($limit)
                ->get();

            if ($productRatings->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'No rated products found',
                    'data' => [],
                    'total' => 0,
                ], 200);
            }

            // Get product IDs
            $productIds = $productRatings->pluck('product_id')->toArray();

            // Fetch products from inventory service
            $productDetails = $this->fetchProductsFromInventory($productIds);

            // Create a map of ratings by product_id
            $ratingsMap = $productRatings->keyBy('product_id');

            // Combine product details with ratings
            $formattedProducts = collect($productDetails)->map(function ($product) use ($ratingsMap) {
                $rating = $ratingsMap->get($product['id']);
                
                return [
                    'product_id' => $product['id'],
                    'average_rating' => $rating ? round((float) $rating->average_rating, 2) : null,
                    'total_reviews' => $rating ? (int) $rating->total_reviews : 0,
                    'product_details' => $product,
                ];
            })->sortByDesc(function ($product) {
                return [$product['average_rating'], $product['total_reviews']];
            })->values();

            return response()->json([
                'success' => true,
                'message' => 'Top rated products retrieved successfully',
                'data' => $formattedProducts->all(),
                'total' => $formattedProducts->count(),
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to fetch top rated products', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch top rated products',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fetch products from inventory microservice
     * 
     * @param array $productIds
     * @return array
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
                Log::error('Inventory fetch failed for top rated products', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [];
            }

            return $response->json()['products'] ?? [];
        } catch (\Exception $e) {
            Log::error('Inventory fetch error for top rated products', [
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }
}
