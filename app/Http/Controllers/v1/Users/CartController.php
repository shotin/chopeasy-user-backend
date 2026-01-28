<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Retrieve or create a session ID for guest users using cookies.
     */
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
    protected function getVariantDetails(int $variantId): ?array
    {
        try {
            $response = Http::withToken(config('services.inventory.api_token'))
                ->get(config('services.inventory.url') . "/product/variant/{$variantId}");

            if (!$response->successful()) {
                return null;
            }

            $variant = $response->json('variant');

            if (!$variant || !isset($variant['id'])) {
                return null;
            }

            return $variant;
        } catch (\Throwable $e) {
            return null;
        }
    }


    /**
     * Fetch product details from Inventory API and local vendor pricing.
     * 
     * @param int $productId Product ID from inventory
     * @param int|null $vendorId Vendor ID to get custom pricing
     */
    protected function getProductDetails(int $productId, ?int $vendorId = null): ?array
    {
        try {
            $response = Http::withToken(config('services.inventory.api_token'))
                ->get(config('services.inventory.url') . "/product/retail/{$productId}");

            if (!$response->successful()) {
                return null;
            }

            $product = $response->json();
            if (!$product || !isset($product['id'])) {
                return null;
            }

            // If no vendor_id passed, try to extract from inventory API
            if (!$vendorId && (isset($product['vendor']) || isset($product['user']))) {
                $vendorData = $product['vendor'] ?? $product['user'] ?? null;
                $vendorId = $vendorData['id'] ?? null;
            }

            // Query local vendor_product_items table for vendor's custom price
            $vendorSetPrice = null;
            $vendorProductItem = null;
            $vendor = null;
            
            if ($vendorId) {
                // Query local database for vendor's price
                $vendorProductItem = \App\Models\VendorProductItem::where('product_id', $productId)
                    ->where('vendor_id', $vendorId)
                    ->with('vendor') // Eager load vendor details
                    ->first();
                
                if ($vendorProductItem) {
                    $vendorSetPrice = $vendorProductItem->price;
                    
                    // Get vendor info from local database
                    if ($vendorProductItem->vendor) {
                        $vendor = [
                            'id' => $vendorProductItem->vendor->id,
                            'fullname' => $vendorProductItem->vendor->fullname ?? null,
                            'username' => $vendorProductItem->vendor->username ?? null,
                            'email' => $vendorProductItem->vendor->email ?? null,
                            'phoneno' => $vendorProductItem->vendor->phoneno ?? null,
                            'address' => $vendorProductItem->vendor->address ?? null,
                            'lga' => $vendorProductItem->vendor->lga ?? null,
                            'state' => $vendorProductItem->vendor->state ?? null,
                            'country' => $vendorProductItem->vendor->country ?? null,
                            'store_name' => $vendorProductItem->vendor->store_name ?? null,
                            'store_image' => $vendorProductItem->vendor->store_image ?? null,
                            'latitude' => $vendorProductItem->vendor->latitude ?? null,
                            'longitude' => $vendorProductItem->vendor->longitude ?? null,
                        ];
                    }
                }
            }

            return [
                'id' => $product['id'],
                'name' => $product['name'],
                'cost' => $vendorSetPrice, // Use ONLY vendor's price
                'original_cost' => $product['cost'] ?? 0, 
                'price' => $vendorSetPrice, // Vendor's actual price from local DB
                'weight_kg' => $product['weight_kg'] ?? $product['weight'] ?? 0,
                'category_id' => $product['category_id'] ?? null,
                'product_for' => $product['product_for'] ?? 'retail',
                'image' => $product['image'] ?? null,
                'other_images' => json_decode($product['other_images'] ?? '[]', true),
                'unit' => isset($product['unit']) ? (array) $product['unit'] : null,
                'vendor' => $vendor, // Include vendor information from local DB
                'vendor_product_item_id' => $vendorProductItem?->id, // Reference to local pricing
            ];
        } catch (\Throwable $e) {
            Log::error('Error fetching product details', [
                'product_id' => $productId,
                'vendor_id' => $vendorId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Add product to cart for user or guest.
     */

    public function addToCart(Request $request)
    {
        $request->validate([
            'vendor_product_item_id' => 'required|integer|exists:vendor_product_items,id',
            'quantity' => 'required|integer|min:1',
            'product_variant_id'  => 'nullable|integer',
        ]);

        Auth::shouldUse('api');
        $userId = Auth::check() ? Auth::id() : null;

        $cookie = null;
        $sessionId = $userId ? null : $this->getSessionId($request, $cookie);

        $productVariantId = $request->input('product_variant_id');
        $variantSnapshot = $productVariantId ? $this->getVariantDetails($productVariantId) : null;

        // Get vendor product item from local database
        $vendorProductItem = \App\Models\VendorProductItem::with('vendor')->find($request->vendor_product_item_id);
        
        if (!$vendorProductItem) {
            return $this->buildResponse(['error' => 'Vendor product not found'], 404, $cookie);
        }

        // Get product details from inventory API
        $product = $this->getProductDetails($vendorProductItem->product_id, $vendorProductItem->vendor_id);
        if (!$product) {
            return $this->buildResponse(['error' => 'Product not found in inventory'], 404, $cookie);
        }

        $variant = null;
        if ($request->filled('product_variant_id')) {
            $variant = $this->getVariantDetails($request->product_variant_id);

            if (!$variant) {
                return $this->buildResponse(['error' => 'Product Variant not found'], 404, $cookie);
            }

            if ((int) $variant['product_id'] !== (int) $request->product_id) {
                return $this->buildResponse([
                    'error' => 'The selected product variant does not belong to the specified product.'
                ], 422, $cookie);
            }
        }

        if (is_null($userId) && is_null($sessionId)) {
            return $this->buildResponse(['error' => 'Unauthorized or session missing'], 401, $cookie);
        }

        if ($userId && $sessionId) {
            $this->mergeSessionCartToUser($userId, $sessionId);
            $sessionId = null;
            Cookie::queue(Cookie::forget('cart_session_id'));
        }

        $cartItem = Cart::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })
            ->where('product_id', $product['id'])
            ->where(function ($q) use ($productVariantId) {
                if ($productVariantId) {
                    $q->where('product_variant_id', $productVariantId);
                } else {
                    $q->whereNull('product_variant_id');
                }
            })
            ->first();

        // Use vendor's price (already prioritized in getProductDetails)
        $priceToUse = $product['cost']; // This is already the vendor's price from getProductDetails

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->price_at_addition = $priceToUse;
            $cartItem->total_cost = $cartItem->quantity * $cartItem->price_at_addition;
            $cartItem->product_snapshot = $product; // Update snapshot with latest vendor info
            $cartItem->save();
        } else {
            $cartItem = Cart::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'product_id' => $product['id'],
                'quantity' => $request->quantity,
                'price_at_addition' => $priceToUse,
                'total_cost' => $request->quantity * $priceToUse,
                'product_snapshot' => $product,
                'product_variant_id' => $productVariantId,
                'variant_snapshot' => $variantSnapshot,
            ]);
        }

        return $this->buildResponse([
            'message' => 'Product added to cart',
            'cart_item' => $cartItem,
            'session_id' => $sessionId,
        ], 200, $cookie);
    }

    /**
     * Update quantity of a cart item.
     */
    public function updateQuantity(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|integer|exists:carts,id',
            'quantity' => 'required|integer|min:1',
            'operation' => 'nullable|in:add,subtract,set',
        ]);

        Auth::shouldUse('api');
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $userId ? null : $this->getSessionId($request);

        $cartItem = Cart::find($request->cart_item_id);

        // Authorization check
        if ($userId && $cartItem->user_id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if (!$userId && $cartItem->session_id !== $sessionId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $operation = $request->input('operation', 'set');

        if ($operation === 'add') {
            $cartItem->quantity += $request->quantity;
        } elseif ($operation === 'subtract') {
            $cartItem->quantity -= $request->quantity;
            if ($cartItem->quantity < 1) {
                return response()->json(['error' => 'Minimum quantity is 1'], 400);
            }
        } else { // set
            $cartItem->quantity = $request->quantity;
        }

        $cartItem->total_cost = $cartItem->quantity * $cartItem->price_at_addition;
        $cartItem->save();

        return response()->json([
            'message' => 'Cart updated',
            'cart_item' => $cartItem,
        ]);
    }

    /**
     * Remove item from cart.
     */
    public function removeFromCart(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|integer|exists:carts,id',
        ]);

        Auth::shouldUse('api');
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $userId ? null : $this->getSessionId($request);

        $cartItem = Cart::find($request->cart_item_id);

        // Authorization check
        if ($userId && $cartItem->user_id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if (!$userId && $cartItem->session_id !== $sessionId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $cartItem->delete();

        return response()->json([
            'message' => 'Item removed from cart',
            'cart_item_id' => $request->cart_item_id,
        ]);
    }

    /**
     * View all cart items for user or guest.
     */
    public function viewCart(Request $request)
    {
        Auth::shouldUse('api');
        $userId = Auth::check() ? Auth::id() : null;

        // Support explicit session_id from request for guests
        $sessionId = $userId ? null : ($request->session_id ?? $this->getSessionId($request));

        $cartItems = Cart::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->get();

        if ($cartItems->isEmpty()) {
            if ($userId) {
                return response()->json([
                    'error' => 'You have no items in your cart.'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Cart is empty or session expired.',
                    'error' => []
                ], 200);
            }
        }

        $totalPrice = $cartItems->sum(fn($item) => ($item->price_at_addition ?? 0) * $item->quantity);

        return response()->json([
            'cart_items' => CartItemResource::collection($cartItems),
            'total_price' => number_format($totalPrice, 2),
            'total_items' => $cartItems->count(),
            'session_id' => $sessionId,
        ]);
    }

    public function addMultipleToCart(Request $request)
    {
        $request->validate([
            'products' => 'required|array|min:1',
            'products.*.vendor_product_item_id' => 'required|integer|exists:vendor_product_items,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.product_variant_id' => 'nullable|integer',
        ]);

        Auth::shouldUse('api');
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $userId ? null : $this->getSessionId($request);
        $cookie = Cookie::make('cart_session_id', $sessionId, 60 * 24 * 30);

        if ($userId && $sessionId) {
            $this->mergeSessionCartToUser($userId, $sessionId);
            $sessionId = null;
            Cookie::queue(Cookie::forget('cart_session_id'));
        }

        $addedItems = [];

        foreach ($request->products as $item) {
            // Get vendor product item from local database
            $vendorProductItem = \App\Models\VendorProductItem::with('vendor')->find($item['vendor_product_item_id']);
            
            if (!$vendorProductItem) {
                continue; // Skip if vendor product not found
            }

            $product = $this->getProductDetails($vendorProductItem->product_id, $vendorProductItem->vendor_id);
            if (!$product) {
                continue; // Skip if product not found in inventory
            }

            // Get and validate variant
            $productVariantId = $item['product_variant_id'] ?? null;
            $variant = null;
            if ($productVariantId) {
                $variant = $this->getVariantDetails($productVariantId);

                if (!$variant || (int) $variant['product_id'] !== (int) $vendorProductItem->product_id) {
                    continue; // skip if variant is invalid or mismatched
                }
            }

            $cartItem = Cart::where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
                ->where('product_id', $product['id'])
                ->where(function ($q) use ($productVariantId) {
                    if ($productVariantId) {
                        $q->where('product_variant_id', $productVariantId);
                    } else {
                        $q->whereNull('product_variant_id');
                    }
                })
                ->first();

            // Prioritize variant price, then vendor's product price
            $cost = $variant['price'] ?? $variant['cost'] ?? $product['cost'];

            if ($cartItem) {
                $cartItem->quantity += $item['quantity'];
                $cartItem->price_at_addition = $cost;
                $cartItem->total_cost = $cartItem->quantity * $cost;
                $cartItem->save();
            } else {
                $cartItem = Cart::create([
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'product_id' => $product['id'],
                    'product_variant_id' => $productVariantId,
                    'quantity' => $item['quantity'],
                    'price_at_addition' => $cost,
                    'total_cost' => $item['quantity'] * $cost,
                    'product_snapshot' => $product,
                    'variant_snapshot' => $variant,
                ]);
            }

            $addedItems[] = $cartItem;
        }

        if (empty($addedItems)) {
            return response()->json(['error' => 'No valid products added'], 400);
        }

        return response()->json([
            'message' => 'Products added to cart',
            'cart_items' => $addedItems,
            'session_id' => $sessionId,
        ])->withCookie($cookie);
    }

    public function deleteMultipleFromCart(Request $request)
    {
        $request->validate([
            'cart_item_ids' => 'required|array|min:1',
            'cart_item_ids.*' => 'integer|exists:carts,id',
        ]);

        Auth::shouldUse('api');
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $userId ? null : $this->getSessionId($request);

        $deleted = Cart::whereIn('id', $request->cart_item_ids)
            ->where(function ($q) use ($userId, $sessionId) {
                if ($userId) {
                    $q->where('user_id', $userId);
                } else {
                    $q->where('session_id', $sessionId);
                }
            })
            ->delete();

        if ($deleted === 0) {
            return response()->json(['error' => 'No items deleted or items not found for user/session'], 404);
        }

        return response()->json([
            'message' => 'Selected cart items deleted successfully.',
            'deleted_count' => $deleted,
        ]);
    }


    /**
     * Merge guest session cart to authenticated user cart.
     */
    protected function mergeSessionCartToUser(int $userId, string $sessionId): void
    {
        DB::transaction(function () use ($userId, $sessionId) {
            Cart::where('session_id', $sessionId)
                ->whereNull('user_id')
                ->update(['user_id' => $userId, 'session_id' => null]);
        });
    }

    protected function buildResponse(array $data, int $status = 200, $cookie = null)
    {
        $response = response()->json($data, $status);

        if ($cookie) {
            $response->withCookie($cookie);
        }

        return $response;
    }
}
