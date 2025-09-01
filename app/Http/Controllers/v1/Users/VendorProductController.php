<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VendorProduct;
use App\Models\VendorProductItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class VendorProductController extends Controller
{
    /**
     * List all categories added by vendors in the B2C system
     */
    public function listVendorCategories(Request $request)
    {
        try {
            $categoryIds = VendorProduct::distinct()
                ->pluck('category_id')
                ->filter()
                ->values();

            if ($categoryIds->isEmpty()) {
                return response()->json([
                    'categories' => [],
                    'message' => 'No categories found'
                ], 200);
            }

            $response = Http::withToken(config('services.inventory.api_token'))
                ->post(config('services.inventory.url') . '/retail/categories/bulk', [
                    'category_ids' => $categoryIds->toArray(),
                ]);

            if (!$response->successful()) {
                return response()->json([
                    'error' => 'Failed to fetch category details from inventory',
                    'message' => $response->json()['message'] ?? 'Unknown error'
                ], $response->status());
            }

            $categories = $response->json()['categories'] ?? [];

            $formattedCategories = collect($categories)->map(function ($category) {
                return [
                    'id' => $category['id'],
                    'name' => $category['name'],
                    'code' => $category['code'] ?? null,
                    'description' => $category['description'] ?? null,
                ];
            })->values();

            return response()->json([
                'categories' => $formattedCategories,
                'total' => $formattedCategories->count(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error while fetching vendor categories',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fetch subcategories based on selected category
     */
    public function getSubcategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $response = Http::withToken(config('services.inventory.api_token'))
                ->get(config('services.inventory.url') . '/retail/subcategories', [
                    'category_id' => $request->category_id,
                ]);

            if (!$response->successful()) {
                return response()->json(['error' => 'Failed to fetch subcategories'], $response->status());
            }

            return response()->json([
                'subcategories' => $response->json()['subcategories'] ?? [],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error while fetching subcategories',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fetch products based on category or subcategory
     */
    public function getProductsByCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|string',
            'subcategory_id' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $filters = [
                'category_id' => $request->category_id,
            ];

            if ($request->filled('subcategory_id')) {
                $filters['subcategory_id'] = $request->subcategory_id;
            }

            $response = Http::withToken(config('services.inventory.api_token'))
                ->post(config('services.inventory.url') . '/retail/products', $filters);

            if (!$response->successful()) {
                return response()->json(['error' => 'Failed to fetch products'], $response->status());
            }

            return response()->json([
                'products' => $response->json()['data'] ?? [],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error while fetching products',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * List all vendors with formatted details
     */
    public function listVendors(Request $request)
    {
        try {
            // Determine page size from query param or default to 10
            $perPage = $request->get('per_page', 10);

            // Paginate vendors instead of fetching all
            $vendors = User::where('user_type', 'vendor')
                ->where('is_active', 1)
                ->leftJoin('vendor_profiles', 'users.id', '=', 'vendor_profiles.vendor_id')
                ->select([
                    'users.id',
                    'users.fullname',
                    'users.address',
                    'users.state',
                    'users.country',
                    'users.is_verified',
                    'users.created_at',
                    'vendor_profiles.description',
                    'vendor_profiles.store_type',
                    'vendor_profiles.delivery_time',
                    'vendor_profiles.logo',
                ])
                ->paginate($perPage);

            // Map the paginated collection
            $vendors->getCollection()->transform(function ($vendor) {
                $reviews = DB::table('product_reviews')
                    ->where('user_id', $vendor->id)
                    ->select(DB::raw('AVG(rating) as average_rating, COUNT(*) as review_count'))
                    ->first();

                return [
                    'id' => $vendor->id,
                    'name' => $vendor->fullname,
                    'is_verified' => $vendor->is_verified ? 'Verified' : 'Not Verified',
                    'description' => $vendor->description ?? 'Fresh produce and organic groceries',
                    'store_type' => $vendor->store_type ?? 'Grocery Store',
                    'distance' => '0.5km', // Replace with geolocation logic
                    'rating' => round($reviews->average_rating ?? 0, 1),
                    'reviews' => $reviews->review_count ?? 0,
                    'delivery_time' => $vendor->delivery_time ?? '15-30 min',
                    'address' => $vendor->address,
                    'state' => $vendor->state,
                    'country' => $vendor->country,
                    'logo' => $vendor->logo
                        ? $vendor->logo
                        : 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg',
                    'created_at' => $vendor->created_at->format('Y-m-d H:i:s'),

                ];
            });

            return response()->json($vendors, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error while fetching vendors',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update vendor profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if ($user->user_type !== 'vendor') {
            return response()->json(['error' => 'Unauthorized. Only vendors can update profiles.'], 403);
        }

        $request->validate([
            'description' => 'nullable|string',
            'store_type' => 'nullable|string',
            'delivery_time' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $profile = \App\Models\VendorProfile::firstOrCreate(['vendor_id' => $user->id]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $profile->logo = $logoPath;
        }

        $profile->update($request->only(['description', 'store_type', 'delivery_time', 'latitude', 'longitude']));

        return response()->json(['message' => 'Profile updated successfully', 'profile' => $profile], 200);
    }

    /**
     * Create vendor products (save as JSON)
     */

    /**
     * Store vendor products (create multiple rows).
     */
    public function storeVendorProducts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|exists:users,id',
            'category_id' => 'required|string',
            'category_name' => 'required|string', // new
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer',
            'products.*.name' => 'required|string',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.uom' => 'required|string',
            'products.*.logo' => 'nullable|string', // new
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            foreach ($request->products as $product) {
                // Check if this vendor already has this product
                $exists = VendorProductItem::where('vendor_id', $request->vendor_id)
                    ->where('product_id', $product['product_id'])
                    ->exists();

                if ($exists) {
                    return response()->json([
                        'error' => "Product '{$product['name']}' already exists."
                    ], 409);
                }

                VendorProductItem::create([
                    'vendor_id' => $request->vendor_id,
                    'category_id' => $request->category_id,
                    'category_name' => $request->category_name,
                    'product_id' => $product['product_id'],
                    'name' => $product['name'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'uom' => $product['uom'],
                    'logo' => $product['logo'] ?? null,
                ]);
            }

            return response()->json([
                'message' => 'Products successfully added to vendor inventory'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error while saving products',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Update single vendor product item.
     */
    public function updateVendorProducts(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'vendorId' => 'required|integer|exists:users,id',
            'name' => 'sometimes|string',
            'quantity' => 'sometimes|integer|min:1',
            'price' => 'sometimes|numeric|min:0',
            'uom' => 'sometimes|string',
            'category_id' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $vendorProduct = VendorProductItem::where('vendor_id', $request->vendorId)->findOrFail($id);

            $vendorProduct->update($request->only([
                'name',
                'quantity',
                'price',
                'uom',
                'category_id'
            ]));

            return response()->json([
                'message' => 'Vendor product updated successfully',
                'data' => $vendorProduct
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error while updating product',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Delete single vendor product item.
     */
    public function deleteVendorProducts(Request $request)
    {
        $request->validate([
            'vendorId' => 'required|integer|exists:users,id',
            'productIds' => 'required|array',
            'productIds.*' => 'integer|exists:vendor_product_items,id',
        ]);

        $vendorId = $request->vendorId;
        $productIds = $request->productIds;

        try {
            $deletedCount = VendorProductItem::where('vendor_id', $vendorId)
                ->whereIn('id', $productIds)
                ->delete();

            return response()->json([
                'message' => "Deleted {$deletedCount} product(s) successfully"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error while deleting product(s)',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show vendor products (paginated).
     */
    public function showVendorProducts($vendorId)
    {
        try {
            $vendorProducts = VendorProductItem::where('vendor_id', $vendorId)
                ->paginate(10);
            if ($vendorProducts->isEmpty()) {
                return response()->json([
                    'data' => [],
                    'pagination' => [
                        'current_page' => 1,
                        'per_page' => 10,
                        'total' => 0,
                        'last_page' => 1,
                    ],
                ]);
            }


            return response()->json([
                'data' => $vendorProducts->items(),
                'pagination' => [
                    'total' => $vendorProducts->total(),
                    'per_page' => $vendorProducts->perPage(),
                    'current_page' => $vendorProducts->currentPage(),
                    'last_page' => $vendorProducts->lastPage(),
                    'from' => $vendorProducts->firstItem(),
                    'to' => $vendorProducts->lastItem(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error while fetching vendor products',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show a single vendor product item.
     */
    public function showSingleVendorProduct($id)
    {
        try {
            $vendorProduct = VendorProductItem::where('vendor_id', Auth::id())->findOrFail($id);

            return response()->json([
                'data' => $vendorProduct
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error while fetching product',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function publicVendorProducts($vendorId)
    {
        try {
            $products = VendorProductItem::where('vendor_id', $vendorId)->get();

            return response()->json([
                'status' => 'success',
                'data' => $products,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch vendor products',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
