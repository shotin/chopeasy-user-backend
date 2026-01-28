# Microservices Integration Guide

## Overview

This guide explains how to use the Pricing Engine when your **products/inventory are in a separate service** from the user_backend service.

---

## Problem

The pricing engine needs:
- Product weight (kg)
- Product price
- Quantity

But products are stored in a separate `inventory_service` database.

---

## Solution

Pass product data explicitly to the pricing APIs instead of relying on database relationships.

---

## API Changes Made

### ✅ Fixed: Order Estimate Request

**Before:** Validated `product_id` against local products table (failed)

**After:** Only validates `product_id` is an integer (no database lookup)

```php
// OrderEstimateRequest.php
'items.*.product_id' => 'required|integer', // ✅ No exists:products,id check
'items.*.weight_kg' => 'required|numeric|min:0.1',
'items.*.price' => 'required|numeric|min:0',
```

### ✅ Enhanced: OrderPricingIntegrationService

Now supports two modes:

**Mode 1: Microservices** (pass items data explicitly)
```php
$pricingService->applyPricingToOrder($order, $coordinates, $itemsData);
```

**Mode 2: Monolith** (read from product relationship)
```php
$pricingService->applyPricingToOrder($order, $coordinates);
```

---

## Integration Patterns

### Pattern 1: Order Estimation API

**Client is responsible** for fetching product data and sending complete information.

**Client-side flow:**
```javascript
// 1. Client has cart with product IDs
const cart = [
  { product_id: 123, quantity: 4 },
  { product_id: 456, quantity: 2 }
];

// 2. Client fetches product details from inventory service
const productDetails = await fetch('https://inventory-service.com/api/products', {
  method: 'POST',
  body: JSON.stringify({ ids: [123, 456] })
});
// Returns: { 123: { weight_kg: 10, price: 2000 }, 456: { weight_kg: 5, price: 1500 } }

// 3. Client builds complete items array
const items = cart.map(item => ({
  product_id: item.product_id,
  quantity: item.quantity,
  weight_kg: productDetails[item.product_id].weight_kg,
  price: productDetails[item.product_id].price
}));

// 4. Client calls pricing estimation
const estimate = await fetch('https://api.chopwell.com/api/v1/orders/estimate', {
  method: 'POST',
  headers: { 'Authorization': 'Bearer TOKEN' },
  body: JSON.stringify({
    items: items, // Complete data with weight and price
    pickup_latitude: 6.5244,
    pickup_longitude: 3.3792,
    delivery_latitude: 6.4541,
    delivery_longitude: 3.3947
  })
});
```

---

### Pattern 2: Server-Side Checkout Integration

**Your backend** fetches product data before applying pricing.

#### Option A: Pass Items Data Explicitly (Recommended)

```php
namespace App\Http\Controllers;

use App\Services\OrderPricingIntegrationService;
use App\Services\InventoryService; // Your inventory service client

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // 1. Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => $this->generateOrderNumber(),
            // ... other fields
        ]);

        // 2. Get product IDs from cart
        $cartItems = $request->input('items');
        $productIds = array_column($cartItems, 'product_id');

        // 3. Fetch product details from inventory service
        $productsData = InventoryService::getProductsByIds($productIds);
        // Returns: [123 => ['weight_kg' => 10, 'price' => 2000], ...]

        // 4. Build items data array
        $itemsData = OrderPricingIntegrationService::buildItemsDataFromInventoryService(
            $cartItems,
            $productsData
        );

        // 5. Create order items (store product snapshot)
        foreach ($itemsData as $itemData) {
            $order->items()->create([
                'product_id' => $itemData['product_id'],
                'quantity' => $itemData['quantity'],
                'price' => $itemData['price'],
                'product_snapshot' => [ // Store for future reference
                    'weight_kg' => $itemData['weight_kg'],
                    'price' => $itemData['price'],
                    'name' => $productsData[$itemData['product_id']]['name'] ?? null,
                ],
            ]);
        }

        // 6. Apply pricing with items data
        $pricingService = new OrderPricingIntegrationService();
        $order = $pricingService->applyPricingToOrder($order, [
            'pickup_lat' => $request->pickup_latitude,
            'pickup_lng' => $request->pickup_longitude,
            'delivery_lat' => $request->delivery_latitude,
            'delivery_lng' => $request->delivery_longitude,
        ], $itemsData); // ✅ Pass items data explicitly

        return response()->json([
            'success' => true,
            'order' => $order,
            'pricing_summary' => $pricingService->getPricingSummary($order),
        ]);
    }
}
```

#### Option B: Store Weight in product_snapshot

If you store product details in `product_snapshot` when creating order items:

```php
// When creating order items, include weight in snapshot
$order->items()->create([
    'product_id' => $productId,
    'quantity' => $quantity,
    'price' => $price,
    'product_snapshot' => [
        'weight_kg' => $productWeight, // ✅ Include weight here
        'name' => $productName,
        'sku' => $productSku,
        // ... other product details
    ],
]);

// Then apply pricing without itemsData (it will read from snapshot)
$pricingService = new OrderPricingIntegrationService();
$order = $pricingService->applyPricingToOrder($order, $coordinates);
// ✅ This now works - reads weight from product_snapshot
```

---

### Pattern 3: Example Inventory Service Client

Create a service to interact with your inventory microservice:

```php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class InventoryService
{
    private static string $baseUrl = 'https://inventory-service.com/api';

    /**
     * Get products by IDs
     * 
     * @param array $productIds
     * @return array Keyed by product_id
     */
    public static function getProductsByIds(array $productIds): array
    {
        try {
            $response = Http::timeout(10)
                ->post(self::$baseUrl . '/products/bulk', [
                    'ids' => $productIds,
                ]);

            if (!$response->successful()) {
                throw new Exception('Failed to fetch products from inventory service');
            }

            $products = $response->json('data', []);

            // Reformat to be keyed by product_id
            $result = [];
            foreach ($products as $product) {
                $result[$product['id']] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'weight_kg' => $product['weight_kg'],
                    'price' => $product['price'],
                    'sku' => $product['sku'],
                ];
            }

            return $result;

        } catch (Exception $e) {
            \Log::error('Inventory Service Error: ' . $e->getMessage());
            throw new Exception('Unable to fetch product details');
        }
    }

    /**
     * Get single product
     */
    public static function getProduct(int $productId): ?array
    {
        $products = self::getProductsByIds([$productId]);
        return $products[$productId] ?? null;
    }
}
```

---

## Complete Example: Checkout Flow

```php
use App\Services\OrderPricingIntegrationService;
use App\Services\InventoryService;

public function checkout(CheckoutRequest $request)
{
    DB::beginTransaction();
    
    try {
        // Step 1: Fetch products from inventory service
        $cartItems = $request->input('cart_items');
        $productIds = array_column($cartItems, 'product_id');
        $productsData = InventoryService::getProductsByIds($productIds);

        // Step 2: Build items data with weight and price
        $itemsData = [];
        foreach ($cartItems as $cartItem) {
            $product = $productsData[$cartItem['product_id']];
            $itemsData[] = [
                'product_id' => $product['id'],
                'quantity' => $cartItem['quantity'],
                'weight_kg' => $product['weight_kg'],
                'price' => $product['price'],
            ];
        }

        // Step 3: Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . time(),
            'shipping_address_id' => $request->shipping_address_id,
        ]);

        // Step 4: Create order items with product snapshot
        foreach ($itemsData as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'product_snapshot' => [
                    'weight_kg' => $item['weight_kg'],
                    'price' => $item['price'],
                    'name' => $productsData[$item['product_id']]['name'],
                    'sku' => $productsData[$item['product_id']]['sku'],
                ],
            ]);
        }

        // Step 5: Apply pricing
        $pricingService = new OrderPricingIntegrationService();
        $order = $pricingService->applyPricingToOrder($order, [
            'pickup_lat' => $request->pickup_latitude,
            'pickup_lng' => $request->pickup_longitude,
            'delivery_lat' => $request->delivery_latitude,
            'delivery_lng' => $request->delivery_longitude,
        ], $itemsData);

        // Step 6: Process payment, etc.
        // ...

        DB::commit();

        return response()->json([
            'success' => true,
            'order' => $order->load('items'),
            'total_to_pay' => $order->total_amount,
            'delivery_charge' => $order->computed_total_charge,
        ]);

    } catch (Exception $e) {
        DB::rollBack();
        
        return response()->json([
            'success' => false,
            'message' => 'Checkout failed',
            'error' => $e->getMessage(),
        ], 500);
    }
}
```

---

## API Request Examples

### Estimation Request (Complete)

```bash
curl -X POST "https://api.chopwell.com/api/v1/orders/estimate" \
  -H "Authorization: Bearer TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "items": [
      {
        "product_id": 123,
        "quantity": 4,
        "weight_kg": 10.0,
        "price": 2000.00
      },
      {
        "product_id": 456,
        "quantity": 2,
        "weight_kg": 5.0,
        "price": 1500.00
      }
    ],
    "pickup_latitude": 6.5244,
    "pickup_longitude": 3.3792,
    "delivery_latitude": 6.4541,
    "delivery_longitude": 3.3947
  }'
```

**Note:** All required fields (`weight_kg`, `price`) are provided in the request.

---

## Migration from Monolith to Microservices

### Phase 1: Add product_snapshot (No Breaking Changes)

```php
// Update order item creation to include snapshot
$order->items()->create([
    'product_id' => $productId,
    'quantity' => $quantity,
    'price' => $price,
    'product_snapshot' => [
        'weight_kg' => $product->weight_kg, // ✅ Add this
        'name' => $product->name,
    ],
]);
```

### Phase 2: Switch to Microservices

```php
// Replace Product model calls with InventoryService
// Before:
$product = Product::find($productId);

// After:
$product = InventoryService::getProduct($productId);
```

### Phase 3: Update Pricing Calls

```php
// Pass items data explicitly
$order = $pricingService->applyPricingToOrder($order, $coordinates, $itemsData);
```

---

## Troubleshooting

### Error: "Weight data not available for item"

**Cause:** Order items don't have weight in `product_snapshot` and product relationship doesn't exist.

**Solution:** Pass `$itemsData` parameter:
```php
$order = $pricingService->applyPricingToOrder($order, $coordinates, $itemsData);
```

### Error: "Product data not found for product_id"

**Cause:** Inventory service didn't return data for a product.

**Solution:** Verify product exists in inventory service and IDs match.

### Estimation works but checkout fails

**Cause:** Not passing items data during checkout integration.

**Solution:** Ensure you fetch product data and pass it to `applyPricingToOrder()`.

---

## Best Practices

### 1. Always Store product_snapshot

```php
$order->items()->create([
    'product_snapshot' => [
        'weight_kg' => $productWeight, // ✅ Required for pricing
        'price' => $price,
        'name' => $productName,
        // ... other fields
    ],
]);
```

### 2. Cache Product Data

```php
// Cache frequently accessed products
$productsData = Cache::remember("products_{$productIds}", 600, function () use ($productIds) {
    return InventoryService::getProductsByIds($productIds);
});
```

### 3. Handle Inventory Service Failures

```php
try {
    $productsData = InventoryService::getProductsByIds($productIds);
} catch (Exception $e) {
    // Fallback: use cached data or return error
    return response()->json([
        'success' => false,
        'message' => 'Unable to fetch product details. Please try again.',
    ], 503);
}
```

### 4. Validate Product Availability

```php
// Ensure all products are available
foreach ($cartItems as $item) {
    if (!isset($productsData[$item['product_id']])) {
        return response()->json([
            'success' => false,
            'message' => "Product {$item['product_id']} not found",
        ], 404);
    }
}
```

---

## Summary

| Scenario | Solution |
|----------|----------|
| **Estimation API** | Client provides weight_kg and price |
| **Checkout (Option 1)** | Pass $itemsData to applyPricingToOrder() |
| **Checkout (Option 2)** | Store weight in product_snapshot |
| **Inventory Service** | Create HTTP client to fetch product data |
| **Validation** | product_id validated as integer only |

---

## Additional Resources

- `PRICING_ENGINE_DOCUMENTATION.md` - Full API documentation
- `PRICING_ENGINE_QUICKSTART.md` - Quick setup guide
- `OrderPricingIntegrationService.php` - Service source code

---

**Questions?** Check the main documentation or review the `OrderPricingIntegrationService` source code for implementation details.
