# Pricing Engine Quick Start Guide

## 🚀 Get Started in 5 Minutes

### Step 1: Run Migrations

```bash
cd /path/to/user_backend
php artisan migrate
```

This will:
- ✅ Create all pricing tables
- ✅ Add pricing fields to orders table
- ✅ Seed default configuration for NG-DEFAULT region
- ✅ Create 6 weight tiers (1-50kg)
- ✅ Create 4 rider payout rules

### Step 2: Verify Installation

```bash
php artisan tinker
```

```php
// Check if pricing config exists
>>> \App\Models\PricingConfig::count()
=> 1

// Check if weight tiers exist
>>> \App\Models\WeightTier::count()
=> 6

// Get active config
>>> \App\Models\PricingConfig::getActiveConfig()
=> App\Models\PricingConfig {
     id: 1,
     name: "Default Nigeria Config",
     base_charge: "1500.00",
     service_charge: "200.00",
     ...
   }
```

### Step 3: Test Pricing Calculation

```php
// In tinker
>>> $service = new \App\Services\PricingService('NG-DEFAULT');
>>> $pricing = $service->calculateOrderPricing(4, 40.0, 10.0, 8000.00);
>>> $pricing['total_charge']
=> 2950.0

// Run validation example
>>> print_r(\App\Tests\Validation\PricingValidationExample::validateSampleCalculation());
```

### Step 4: Test API Endpoints

#### Get Public Pricing Rates
```bash
curl -X GET "http://localhost:8000/api/v1/pricing-rates?region_id=NG-DEFAULT"
```

#### Test Order Estimation (requires auth)
```bash
curl -X POST "http://localhost:8000/api/v1/orders/estimate" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "items": [
      {
        "product_id": 1,
        "quantity": 4,
        "weight_kg": 10.0,
        "price": 2000.00
      }
    ],
    "pickup_latitude": 6.5244,
    "pickup_longitude": 3.3792,
    "delivery_latitude": 6.4541,
    "delivery_longitude": 3.3947
  }'
```

#### Admin: Preview Pricing (requires admin token)
```bash
curl -X POST "http://localhost:8000/api/v1/admin/pricing-preview" \
  -H "Authorization: Bearer ADMIN_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "region_id": "NG-DEFAULT",
    "scenarios": [
      {
        "item_count": 4,
        "total_weight": 40.0,
        "distance_km": 10.0,
        "vendor_subtotal": 8000.00
      }
    ]
  }'
```

---

## 📖 Understanding the Formula

```
TotalCharge = baseCharge + (serviceCharge × itemCount) 
            + (chargePerDistance × distanceInKm) 
            + baseServiceFee(weightRange)
```

**Example:**
- Base: ₦1,500
- Service: ₦200 × 4 items = ₦800
- Distance: ₦15 × 10km = ₦150
- Weight: ₦100 × 5 (40kg tier) = ₦500
- **Total: ₦2,950**

---

## 🔧 Common Admin Tasks

### Update Pricing Config
```bash
curl -X PATCH "http://localhost:8000/api/v1/admin/pricing-config/1" \
  -H "Authorization: Bearer ADMIN_TOKEN" \
  -d '{
    "base_charge": 1600,
    "service_charge": 220
  }'
```

### Add New Weight Tier
```bash
curl -X POST "http://localhost:8000/api/v1/admin/weight-tiers" \
  -H "Authorization: Bearer ADMIN_TOKEN" \
  -d '{
    "min_weight": 50.01,
    "max_weight": 75.00,
    "multiplier": 7,
    "base_service_fee": 100,
    "region_id": "NG-DEFAULT",
    "is_active": true
  }'
```

### Validate Configuration
```bash
curl -X POST "http://localhost:8000/api/v1/admin/pricing-validate" \
  -H "Authorization: Bearer ADMIN_TOKEN" \
  -d '{"region_id": "NG-DEFAULT"}'
```

---

## 🎯 Integration in Existing Code

### During Checkout

Add to your `OrderController::checkout()` method:

```php
use App\Services\OrderPricingIntegrationService;

public function checkout(Request $request)
{
    // Your existing order creation logic
    $order = Order::create([
        'user_id' => auth()->id(),
        'order_number' => $this->generateOrderNumber(),
        // ... other fields
    ]);

    // Add items
    foreach ($request->items as $item) {
        $order->items()->create([
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    // 🚀 APPLY PRICING (New)
    $pricingService = new OrderPricingIntegrationService();
    $order = $pricingService->applyPricingToOrder($order, [
        'pickup_lat' => $request->pickup_latitude,
        'pickup_lng' => $request->pickup_longitude,
        'delivery_lat' => $request->delivery_latitude,
        'delivery_lng' => $request->delivery_longitude,
    ]);

    // Order now has all pricing data populated
    return response()->json([
        'success' => true,
        'order' => $order,
        'pricing_summary' => $pricingService->getPricingSummary($order),
    ]);
}
```

---

## 📊 Sample Outputs

### Estimate Response (Simplified)
```json
{
  "success": true,
  "data": {
    "pricing": {
      "total_charge": 2950.00,
      "payout_breakdown": {
        "platform_revenue": 1750.00,
        "rider_payout": 1200.00,
        "vendor_payout": 8000.00,
        "total_to_collect_from_customer": 10950.00
      }
    }
  }
}
```

### Order After Pricing Applied
```json
{
  "id": 123,
  "order_number": "ORD-2026-001",
  "total_amount": 10950.00,
  "computed_total_charge": 2950.00,
  "platform_revenue": 1750.00,
  "rider_payout": 1200.00,
  "vendor_payout": 8000.00,
  "total_weight": 40.00,
  "distance_in_km": 10.00,
  "pricing_breakdown": { "...": "..." }
}
```

---

## 🛠️ Troubleshooting

### Error: "Pricing configuration not available"
```bash
# Check if config exists
php artisan tinker
>>> \App\Models\PricingConfig::where('is_active', true)->get()

# If empty, run migrations again
php artisan migrate:fresh
```

### Error: "Weight tier not configured"
```bash
# Check weight tiers
>>> \App\Models\WeightTier::orderedByWeight()->get()

# Add missing tier
>>> \App\Models\WeightTier::create([
    'min_weight' => 50.01,
    'max_weight' => 100.00,
    'multiplier' => 7,
    'base_service_fee' => 100,
    'region_id' => 'NG-DEFAULT',
    'is_active' => true
]);
```

### Distance Calculation Issues
```bash
# Test distance calculation
curl -X POST "http://localhost:8000/api/v1/calculate-distance" \
  -H "Content-Type: application/json" \
  -d '{
    "pickup_latitude": 6.5244,
    "pickup_longitude": 3.3792,
    "delivery_latitude": 6.4541,
    "delivery_longitude": 3.3947
  }'
```

---

## 📚 Next Steps

1. **Read Full Documentation**
   - `PRICING_ENGINE_DOCUMENTATION.md` - Complete API docs
   - `PRICING_ENGINE_IMPLEMENTATION.md` - Architecture details

2. **Test Thoroughly**
   - Run validation examples
   - Test edge cases (1kg, 50kg, long distances)
   - Verify margin calculations

3. **Customize for Your Region**
   - Create region-specific configs
   - Adjust weight tiers as needed
   - Configure rider payout rules

4. **Build Admin Dashboard**
   - UI for pricing management
   - Preview tool
   - Analytics dashboard

5. **Monitor & Optimize**
   - Track platform margins
   - Analyze order patterns
   - Adjust pricing based on data

---

## 🎉 You're Ready!

The pricing engine is now fully operational. All calculations are automatic, and admins can adjust pricing without code changes.

**Key Files:**
- 📁 Models: `app/Models/PricingConfig.php`, `WeightTier.php`, `RiderPayoutRule.php`
- 🔧 Services: `app/Services/PricingService.php`
- 🌐 Controllers: `app/Http/Controllers/Admin/*` and `v1/Orders/OrderPricingController.php`
- 📝 Routes: `routes/api.php` (search for "pricing")

**Need Help?**
- Check `PRICING_ENGINE_DOCUMENTATION.md` for API examples
- Check `PRICING_ENGINE_IMPLEMENTATION.md` for architecture
- Run `PRICING_VALIDATION_EXAMPLE.php` to verify setup

**Happy Coding! 🚀**
