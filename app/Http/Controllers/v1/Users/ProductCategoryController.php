<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::withToken(config('services.inventory.api_token'))
            ->get(config('services.inventory.url') . '/retail/category', [
                'search' => $request->search,
            ]);

        if (!$response->successful()) {
            return response()->json(['error' => 'Failed to fetch categories'], $response->status());
        }

        $categories = collect($response->json()['categories'] ?? []);

        if ($request->filled('search')) {
            $categories = $categories->filter(function ($category) use ($request) {
                return stripos($category['name'], $request->search) !== false ||
                    stripos($category['code'], $request->search) !== false;
            })->values();
        }

        return response()->json([
            'categories' => $categories->values(),
        ]);
    }

    public function Unitindex(Request $request)
    {
        $response = Http::withToken(config('services.inventory.api_token'))
            ->get(config('services.inventory.url') . '/all/unit', [
                'search' => $request->search,
                'all'    => true, // ensure we get all units
            ]);

        if (!$response->successful()) {
            return response()->json(['error' => 'Failed to fetch units'], $response->status());
        }

        $json = $response->json();

        $units = collect($json['units'] ?? []);

        return response()->json([
            'units' => $units->values(),
        ]);
    }


    public function products(Request $request)
    {
        $filters = $request->all();

        $response = Http::withToken(config('services.inventory.api_token'))
            ->post(config('services.inventory.url') . "/retail/products", $filters);

        if (!$response->successful()) {
            return response()->json(
                $response->json(),
                $response->status()
            );
        }

        return response()->json($response->json(), 200);
    }

    public function nationalityLists(Request $request)
    {
        $filters = $request->all();

        $response = Http::withToken(config('services.inventory.api_token'))
            ->get(config('services.inventory.url') . "/retail/nationality", $filters);

        if (!$response->successful()) {
            return response()->json(
                $response->json(),
                $response->status()
            );
        }

        return response()->json($response->json(), 200);
    }

    public function getProduct(Request $request, $id)
    {
        try {
            $variantUnitId = $request->query('variant_unit_id');

            $url = config('services.inventory.url') . "/product/retail/{$id}";

            if ($variantUnitId) {
                $url .= '?variant_unit_id=' . $variantUnitId;
            }

            $response = Http::withToken(config('services.inventory.api_token'))
                ->get($url);

            if (!$response->successful()) {
                return response()->json($response->json(), $response->status());
            }

            $product = $response->json();

            $reviews = ProductReview::where('product_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();

            $averageRating = $reviews->avg('rating');

            $product['average_rating'] = round($averageRating, 1);
            $product['total_reviews'] = $reviews->count();
            $product['reviews'] = $reviews;

            return response()->json($product, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal server error while fetching product',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getFrequentlyBoughtTogether($id)
    {
        try {
            $orderIds = OrderItem::where('product_id', $id)->pluck('order_id');

            if ($orderIds->isEmpty()) {
                return response()->json([
                    'product_id' => $id,
                    'message' => []
                ], 200);
            }

            $relatedProductIds = OrderItem::whereIn('order_id', $orderIds)
                ->where('product_id', '!=', $id)
                ->pluck('product_id')
                ->countBy()
                ->sortDesc()
                ->take(10)
                ->keys()
                ->toArray();

            if (empty($relatedProductIds)) {
                return response()->json([
                    'product_id' => $id,
                    'message' => []
                ], 200);
            }

            $inventoryResponse = Http::withToken(config('services.inventory.api_token'))
                ->post(config('services.inventory.url') . '/retail/products/bulk', [
                    'product_ids' => $relatedProductIds,
                ]);

            if (!$inventoryResponse->successful()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Unable to fetch product data from inventory.'
                ], $inventoryResponse->status());
            }

            return response()->json([
                'product_id' => $id,
                'frequently_bought_together' => $inventoryResponse->json('data', [])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Server error',
                'exception' => $e->getMessage()
            ], 500);
        }
    }

    public function fetchProductsByCountry(Request $request)
    {
        try {
            $country = $request->input('country');
            $type = $request->input('type');

            $url = config('services.inventory.url') . '/products/by/country';

            $response = Http::post($url, [
                'country' => $country,
                'type' => $type,
            ]);

            if ($response->failed()) {
                $responseBody = json_decode($response->body(), true);
                $message = $responseBody['message'] ?? 'Failed to fetch products';

                return response()->json(['message' => $message], $response->status());
            }

            return response()->json($response->json());
        } catch (\Throwable $e) {
            return response()->json(['message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

    public function getHomePageDashboard(Request $request)
    {
        try {
            $url = config('services.inventory.url') . '/product/dashboard';

            $response = Http::get($url);

            if ($response->failed()) {
                $responseBody = json_decode($response->body(), true);
                $message = $responseBody['message'] ?? 'Failed to fetch dashboard data';

                return response()->json(['message' => $message], $response->status());
            }

            return response()->json($response->json());
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'An unexpected error occurred. Please try again later.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getRelatedProducts($productId)
    {
        try {
            $productResponse = Http::withToken(config('services.inventory.api_token'))
                ->get(config('services.inventory.url') . "/product/retail/{$productId}");

            if (!$productResponse->successful()) {
                return response()->json([
                    'error' => 'Product not found'
                ], $productResponse->status());
            }

            $product = $productResponse->json();
            $categoryId = $product['category_id'] ?? null;

            if (!$categoryId) {
                return response()->json([
                    'error' => 'Product category not found'
                ], 404);
            }

            $response = Http::withToken(config('services.inventory.api_token'))
                ->post(config('services.inventory.url') . '/retail/products', [
                    'category_id' => $categoryId,
                    'type' => 'all'
                ]);

            if (!$response->successful()) {
                return response()->json([
                    'error' => 'Failed to fetch related products'
                ], $response->status());
            }

            $products = $response->json()['data'] ?? [];

            $related = collect($products)
                ->filter(fn($item) => $item['id'] != $productId)
                ->shuffle()
                ->take(4)
                ->values();

            return response()->json([
                'related_products' => $related
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching related products',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
