# ChopWell Pricing Engine Documentation

## Overview

The ChopWell Pricing Engine is a sophisticated, configurable pricing system designed for a food logistics and marketplace platform. It uses **admin-configurable flat + dynamic fees** instead of percentage-based commissions, ensuring platform margin regardless of order value, weight, or distance.

---

## Core Pricing Formula

Every order total is computed using this exact formula:

```
TotalCharge = baseCharge + (serviceCharge × itemCount) + (chargePerDistance × distanceInKm) + baseServiceFee(weightRange)
```

### Formula Components

| Component | Description | Example |
|-----------|-------------|---------|
| `baseCharge` | Fixed platform charge per order (guaranteed margin) | ₦1,500 |
| `serviceCharge` | Charge per item unit | ₦200 per item |
| `itemCount` | Total quantity of items in cart | 4 items |
| `chargePerDistance` | Cost per kilometer | ₦15 per km |
| `distanceInKm` | Calculated delivery distance | 10 km |
| `baseServiceFee(weightRange)` | Weight-based multiplier fee | ₦500 (for 31-40kg) |

---

## Database Schema

### 1. Pricing Configurations Table

```sql
CREATE TABLE pricing_configs (
    id BIGINT PRIMARY KEY,
    name VARCHAR(255),
    base_charge DECIMAL(10,2),
    service_charge DECIMAL(10,2),
    charge_per_distance DECIMAL(10,2),
    referral_bonus_percentage DECIMAL(5,2),
    region_id VARCHAR(50),
    is_active BOOLEAN,
    description TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);
```

### 2. Weight Tiers Table

```sql
CREATE TABLE weight_tiers (
    id BIGINT PRIMARY KEY,
    min_weight DECIMAL(8,2),
    max_weight DECIMAL(8,2),
    multiplier INT,
    base_service_fee DECIMAL(10,2),
    region_id VARCHAR(50),
    is_active BOOLEAN,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);
```

### 3. Rider Payout Rules Table

```sql
CREATE TABLE rider_payout_rules (
    id BIGINT PRIMARY KEY,
    max_distance DECIMAL(8,2),
    flat_payout DECIMAL(10,2),
    weight_limit DECIMAL(8,2),
    additional_per_km DECIMAL(10,2),
    additional_per_kg DECIMAL(10,2),
    region_id VARCHAR(50),
    is_active BOOLEAN,
    priority INT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);
```

### 4. Orders Table (Pricing Fields)

Additional columns added to existing orders table:

```sql
ALTER TABLE orders ADD (
    total_weight DECIMAL(8,2),
    item_count INT,
    distance_in_km DECIMAL(8,2),
    computed_total_charge DECIMAL(10,2),
    platform_revenue DECIMAL(10,2),
    rider_payout DECIMAL(10,2),
    vendor_payout DECIMAL(10,2),
    pricing_config_id BIGINT,
    weight_tier_id BIGINT,
    pricing_breakdown JSON,
    pickup_latitude DECIMAL(10,8),
    pickup_longitude DECIMAL(11,8),
    delivery_latitude DECIMAL(10,8),
    delivery_longitude DECIMAL(11,8)
);
```

---

## Weight-Based Service Fee Model

Admin defines a `baseServiceFee` and weight tiers with multipliers:

| Weight Range | Multiplier | Base Fee | Applied Fee |
|--------------|------------|----------|-------------|
| 1–5 kg | ×1 | ₦100 | ₦100 |
| 6–10 kg | ×2 | ₦100 | ₦200 |
| 11–20 kg | ×3 | ₦100 | ₦300 |
| 21–30 kg | ×4 | ₦100 | ₦400 |
| 31–40 kg | ×5 | ₦100 | ₦500 |
| 41–50 kg | ×6 | ₦100 | ₦600 |

**Note:** The multiplier logic is fully data-driven, not hard-coded.

---

## Sample Calculation

### Order Details
- **Items:** 4 × 10kg bags of rice
- **Total Weight:** 40kg
- **Distance:** 10km
- **Vendor Items Cost:** ₦8,000

### Admin Configuration
- `baseCharge` = ₦1,500
- `serviceCharge` = ₦200
- `chargePerDistance` = ₦15
- `baseServiceFee (1-5kg)` = ₦100

### Calculation Breakdown

```
Base Charge:           ₦1,500
Service Charge:        ₦200 × 4 = ₦800
Distance Charge:       ₦15 × 10 = ₦150
Weight Service Fee:    ₦100 × 5 = ₦500   (31-40kg range)
─────────────────────────────────────
Total Delivery Charge: ₦2,950

Vendor Items Cost:     ₦8,000
─────────────────────────────────────
TOTAL TO PAY:          ₦10,950
```

### Payout Distribution

```
Rider Payout:          ₦1,200  (from rider payout rules)
Platform Revenue:      ₦1,750  (₦2,950 - ₦1,200)
Vendor Payout:         ₦8,000  (items cost)
```

**Platform Margin:** 59.3% of delivery charge

---

## API Documentation

### Base URL
```
https://api.chopwell.com/api/v1
```

---

## User APIs

### 1. Get Pricing Rates (Public)

Get current pricing configuration for transparency.

**Endpoint:** `GET /pricing-rates`

**Query Parameters:**
- `region_id` (optional): Region identifier (default: `NG-DEFAULT`)

**Sample Request:**
```bash
curl -X GET "https://api.chopwell.com/api/v1/pricing-rates?region_id=NG-DEFAULT"
```

**Sample Response:**
```json
{
  "success": true,
  "data": {
    "base_charge": 1500.00,
    "service_charge_per_item": 200.00,
    "charge_per_km": 15.00,
    "weight_tiers": [
      {
        "weight_range": "1kg - 5kg",
        "service_fee": 100.00
      },
      {
        "weight_range": "5.01kg - 10kg",
        "service_fee": 200.00
      },
      {
        "weight_range": "10.01kg - 20kg",
        "service_fee": 300.00
      },
      {
        "weight_range": "20.01kg - 30kg",
        "service_fee": 400.00
      },
      {
        "weight_range": "30.01kg - 40kg",
        "service_fee": 500.00
      },
      {
        "weight_range": "40.01kg - 50kg",
        "service_fee": 600.00
      }
    ],
    "region_id": "NG-DEFAULT"
  }
}
```

---

### 2. Calculate Distance

Calculate distance between pickup and delivery coordinates.

**Endpoint:** `POST /calculate-distance`

**Request Body:**
```json
{
  "pickup_latitude": 6.5244,
  "pickup_longitude": 3.3792,
  "delivery_latitude": 6.4541,
  "delivery_longitude": 3.3947
}
```

**Sample Response:**
```json
{
  "success": true,
  "data": {
    "distance_km": 8.45,
    "distance_meters": 8450.00
  }
}
```

---

### 3. Order Estimate (Authenticated)

Get pricing estimate for an order WITHOUT creating it.

**Endpoint:** `POST /orders/estimate`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**
```json
{
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
  "delivery_longitude": 3.3947,
  "region_id": "NG-DEFAULT"
}
```

**⚠️ Microservices Note:** 
- `product_id` is only used for reference - no database validation against products table
- Product data (weight, price) must be provided in the request
- Products are managed in a separate inventory service

**Sample Response:**
```json
{
  "success": true,
  "message": "Order estimate calculated successfully",
  "data": {
    "order_summary": {
      "item_count": 6,
      "total_weight_kg": 50.00,
      "distance_km": 8.45,
      "vendor_subtotal": 11000.00
    },
    "pricing": {
      "base_charge": 1500.00,
      "service_charge_per_item": 200.00,
      "service_charge_total": 1200.00,
      "charge_per_distance": 15.00,
      "distance_charge_total": 126.75,
      "weight_service_fee": 600.00,
      "weight_tier_multiplier": 6,
      "total_charge": 3426.75,
      "item_count": 6,
      "total_weight_kg": 50.00,
      "distance_km": 8.45,
      "vendor_subtotal": 11000.00,
      "payout_breakdown": {
        "rider_payout": 1200.00,
        "vendor_payout": 11000.00,
        "platform_revenue": 2226.75,
        "platform_margin_percentage": 64.98,
        "total_to_collect_from_customer": 14426.75
      },
      "metadata": {
        "pricing_config_id": 1,
        "pricing_config_name": "Default Nigeria Config",
        "weight_tier_id": 6,
        "weight_tier_range": "40.01kg - 50kg",
        "rider_payout_rule_id": 2,
        "region_id": "NG-DEFAULT",
        "calculated_at": "2026-01-18T10:30:45+00:00"
      }
    },
    "breakdown_explanation": {
      "delivery_charge_breakdown": {
        "base_charge": {
          "amount": 1500.00,
          "description": "Fixed platform charge per order"
        },
        "service_charge": {
          "amount": 1200.00,
          "calculation": "₦200 × 6 items",
          "description": "Charge per item in order"
        },
        "distance_charge": {
          "amount": 126.75,
          "calculation": "₦15 × 8.45km",
          "description": "Cost based on delivery distance"
        },
        "weight_service_fee": {
          "amount": 600.00,
          "calculation": "Base fee × 6 (for 50kg)",
          "description": "Weight-based service fee"
        }
      },
      "total_delivery_charge": 3426.75,
      "payment_summary": {
        "vendor_items_cost": 11000.00,
        "delivery_charge": 3426.75,
        "total_to_pay": 14426.75
      }
    }
  }
}
```

---

## Admin APIs

All admin endpoints require authentication with `Admin` or `Super Admin` role.

**Headers:**
```
Authorization: Bearer {admin_token}
Content-Type: application/json
```

---

### 1. Create Pricing Configuration

**Endpoint:** `POST /admin/pricing-config`

**Request Body:**
```json
{
  "name": "Lagos Premium Config",
  "base_charge": 2000.00,
  "service_charge": 250.00,
  "charge_per_distance": 20.00,
  "referral_bonus_percentage": 5.00,
  "region_id": "NG-LAGOS",
  "is_active": true,
  "description": "Premium pricing for Lagos region"
}
```

**Sample Response:**
```json
{
  "success": true,
  "message": "Pricing configuration created successfully",
  "data": {
    "id": 2,
    "name": "Lagos Premium Config",
    "base_charge": 2000.00,
    "service_charge": 250.00,
    "charge_per_distance": 20.00,
    "referral_bonus_percentage": 5.00,
    "region_id": "NG-LAGOS",
    "is_active": true,
    "description": "Premium pricing for Lagos region",
    "created_at": "2026-01-18T10:30:00Z",
    "updated_at": "2026-01-18T10:30:00Z"
  }
}
```

---

### 2. Get All Pricing Configurations

**Endpoint:** `GET /admin/pricing-config`

**Query Parameters:**
- `region_id` (optional): Filter by region
- `is_active` (optional): Filter by active status
- `page` (optional): Page number for pagination

**Sample Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "Default Nigeria Config",
        "base_charge": 1500.00,
        "service_charge": 200.00,
        "charge_per_distance": 15.00,
        "region_id": "NG-DEFAULT",
        "is_active": true,
        "created_at": "2026-01-18T00:00:00Z"
      }
    ],
    "per_page": 20,
    "total": 1
  }
}
```

---

### 3. Update Pricing Configuration

**Endpoint:** `PATCH /admin/pricing-config/{id}`

**Request Body:**
```json
{
  "name": "Updated Default Config",
  "base_charge": 1600.00,
  "service_charge": 220.00,
  "charge_per_distance": 18.00
}
```

---

### 4. Create Weight Tiers (Bulk)

**Endpoint:** `POST /admin/weight-tiers/bulk`

**Request Body:**
```json
{
  "region_id": "NG-LAGOS",
  "tiers": [
    {
      "min_weight": 1.00,
      "max_weight": 5.00,
      "multiplier": 1,
      "base_service_fee": 150.00
    },
    {
      "min_weight": 5.01,
      "max_weight": 10.00,
      "multiplier": 2,
      "base_service_fee": 150.00
    },
    {
      "min_weight": 10.01,
      "max_weight": 20.00,
      "multiplier": 3,
      "base_service_fee": 150.00
    }
  ]
}
```

**Sample Response:**
```json
{
  "success": true,
  "message": "3 weight tiers created successfully",
  "data": [
    {
      "id": 7,
      "min_weight": 1.00,
      "max_weight": 5.00,
      "multiplier": 1,
      "base_service_fee": 150.00,
      "region_id": "NG-LAGOS",
      "is_active": true
    }
  ]
}
```

---

### 5. Pricing Preview (Simulation)

Test pricing with multiple scenarios before applying.

**Endpoint:** `POST /admin/pricing-preview`

**Request Body:**
```json
{
  "region_id": "NG-DEFAULT",
  "scenarios": [
    {
      "item_count": 4,
      "total_weight": 40.0,
      "distance_km": 10.0,
      "vendor_subtotal": 8000.00
    },
    {
      "item_count": 2,
      "total_weight": 10.0,
      "distance_km": 5.0,
      "vendor_subtotal": 3000.00
    }
  ]
}
```

**Sample Response:**
```json
{
  "success": true,
  "data": {
    "region_id": "NG-DEFAULT",
    "results": [
      {
        "scenario": {
          "item_count": 4,
          "total_weight": 40.0,
          "distance_km": 10.0,
          "vendor_subtotal": 8000.00
        },
        "pricing": {
          "total_charge": 2950.00,
          "payout_breakdown": {
            "platform_revenue": 1750.00,
            "rider_payout": 1200.00,
            "vendor_payout": 8000.00,
            "platform_margin_percentage": 59.32
          }
        }
      }
    ]
  }
}
```

---

### 6. Validate Configuration

Check if pricing configuration is complete for a region.

**Endpoint:** `POST /admin/pricing-validate`

**Request Body:**
```json
{
  "region_id": "NG-DEFAULT"
}
```

**Sample Response:**
```json
{
  "success": true,
  "data": {
    "is_valid": true,
    "issues": [],
    "region_id": "NG-DEFAULT"
  }
}
```

**Invalid Configuration Response:**
```json
{
  "success": true,
  "data": {
    "is_valid": false,
    "issues": [
      "Weight tiers only cover up to 30kg. Consider extending to 50kg.",
      "No rider payout rules configured for region: NG-LAGOS"
    ],
    "region_id": "NG-LAGOS"
  }
}
```

---

### 7. Toggle Active Status

Activate/deactivate a pricing configuration.

**Endpoint:** `POST /admin/pricing-config/{id}/toggle-active`

**Sample Response:**
```json
{
  "success": true,
  "message": "Status updated successfully",
  "data": {
    "id": 1,
    "is_active": false
  }
}
```

---

## Integration Guide

### During Order Checkout

```php
use App\Services\OrderPricingIntegrationService;

// In your OrderController::checkout method

$pricingService = new OrderPricingIntegrationService('NG-DEFAULT');

// After order is created and items are added
$order = $pricingService->applyPricingToOrder($order, [
    'pickup_lat' => $request->pickup_latitude,
    'pickup_lng' => $request->pickup_longitude,
    'delivery_lat' => $request->delivery_latitude,
    'delivery_lng' => $request->delivery_longitude,
]);

// Order now has all pricing fields populated
```

### Microservices Architecture Notes

**If products are in a separate service:**

1. **For Estimation API:** Client must provide `weight_kg` and `price` for each item
2. **Product ID Validation:** The pricing service only validates `product_id` as an integer (no database lookup)
3. **Product Weight:** If using `OrderPricingIntegrationService`, ensure you fetch product weights from your inventory service before calculating pricing

**Example with separate inventory service:**

```php
// Fetch product details from inventory service
$productData = InventoryService::getProductsByIds($productIds);

// Build items array with weight and price
$items = [];
foreach ($cart as $cartItem) {
    $product = $productData[$cartItem['product_id']];
    $items[] = [
        'product_id' => $product['id'],
        'quantity' => $cartItem['quantity'],
        'weight_kg' => $product['weight_kg'], // From inventory service
        'price' => $product['price'],         // From inventory service
    ];
}

// Now call pricing estimation with complete data
$estimate = PricingService::estimate($items, $coordinates);
```

---

## Running Migrations

```bash
# Run migrations to create tables
php artisan migrate

# This will create:
# - pricing_configs table
# - weight_tiers table
# - rider_payout_rules table
# - Add pricing fields to orders table
# - Seed default data for NG-DEFAULT region
```

---

## Key Features

### ✅ Fully Configurable
- All pricing parameters adjustable via Admin Dashboard
- No code deployment needed for pricing changes

### ✅ Multi-Region Support
- Different pricing for different regions
- Easy to add new regions

### ✅ Transparent & Auditable
- Complete pricing breakdown stored with each order
- Historical pricing data preserved

### ✅ Scalable
- Supports 1kg to 50kg+ orders
- Distance-based pricing
- Item count-based pricing

### ✅ Guaranteed Margins
- Platform revenue calculated upfront
- No percentage dependency
- Rider payout rules separate from customer charges

---

## Edge Cases & Validation

### Weight Limits
- System validates weight is between configured tiers
- Error if weight exceeds maximum tier (default 50kg)

### Distance Calculation
- Uses Haversine formula for accurate distance
- Requires valid GPS coordinates

### Configuration Validation
- Only one active config per region
- Weight tiers cannot overlap
- All required fields validated

### Order Repricing
- Orders store snapshot of pricing config used
- Can recalculate if needed
- Historical data preserved

---

## Error Handling

### Common Error Responses

**Missing Configuration:**
```json
{
  "success": false,
  "message": "Pricing configuration not available for region: NG-LAGOS",
  "error": "Pricing configuration not available for region: NG-LAGOS"
}
```

**Weight Tier Not Found:**
```json
{
  "success": false,
  "message": "Failed to calculate order estimate",
  "error": "Weight tier not configured for 55kg. Please configure weight tiers."
}
```

**Invalid Request:**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "items": ["The items field is required"],
    "pickup_latitude": ["The pickup latitude field is required"]
  }
}
```

---

## Performance Considerations

1. **Caching:** Consider caching active pricing configs
2. **Indexing:** Database indexes on `region_id`, `is_active`
3. **Async Processing:** Heavy calculations can be queued
4. **API Rate Limiting:** Implement on estimation endpoints

---

## Security Considerations

1. **Admin Access:** Pricing management restricted to Admin roles
2. **Audit Trail:** All pricing changes logged with timestamps
3. **Validation:** Strict input validation on all endpoints
4. **Soft Deletes:** Configs soft-deleted to preserve history

---

## Support

For questions or issues:
- Email: dev@chopwell.com
- Documentation: https://docs.chopwell.com/pricing
