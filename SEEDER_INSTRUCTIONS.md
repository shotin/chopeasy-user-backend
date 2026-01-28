# Pricing Engine Seeder Instructions

## Quick Start

### Option 1: Run Seeder Only (Recommended for Testing)

```bash
php artisan db:seed --class=PricingEngineSeeder
```

This will:
- ✅ Clear existing pricing data
- ✅ Create 3 pricing configurations (NG-DEFAULT, NG-LAGOS, NG-ABUJA)
- ✅ Create 18 weight tiers (6 per region)
- ✅ Create 12 rider payout rules (4 per region)
- ✅ Display a summary of seeded data

### Option 2: Run All Seeders

If you want to run this with other seeders, add it to `DatabaseSeeder.php`:

```php
public function run(): void
{
    $this->call([
        PricingEngineSeeder::class,
        // ... other seeders
    ]);
}
```

Then run:
```bash
php artisan db:seed
```

---

## What Gets Seeded?

### 1. Pricing Configurations (3 configs)

| Region | Name | Base Charge | Service Charge | Distance Charge | Status |
|--------|------|-------------|----------------|-----------------|--------|
| NG-DEFAULT | Default Nigeria Config | ₦1,500 | ₦200/item | ₦15/km | ✅ Active |
| NG-LAGOS | Lagos Premium Config | ₦2,000 | ₦250/item | ₦20/km | ⭕ Inactive |
| NG-ABUJA | Abuja Config | ₦1,800 | ₦220/item | ₦18/km | ⭕ Inactive |

### 2. Weight Tiers (6 per region = 18 total)

Each region gets the same tier structure with different base fees:

| Weight Range | Multiplier | NG-DEFAULT Fee | NG-LAGOS Fee | NG-ABUJA Fee |
|--------------|------------|----------------|--------------|--------------|
| 1-5 kg | ×1 | ₦100 | ₦150 | ₦120 |
| 5.01-10 kg | ×2 | ₦200 | ₦300 | ₦240 |
| 10.01-20 kg | ×3 | ₦300 | ₦450 | ₦360 |
| 20.01-30 kg | ×4 | ₦400 | ₦600 | ₦480 |
| 30.01-40 kg | ×5 | ₦500 | ₦750 | ₦600 |
| 40.01-50 kg | ×6 | ₦600 | ₦900 | ₦720 |

### 3. Rider Payout Rules (4 per region = 12 total)

#### NG-DEFAULT Rules:
| Distance | Flat Payout | Weight Limit | Additional/km | Additional/kg |
|----------|-------------|--------------|---------------|---------------|
| 0-5 km | ₦500 | 10kg | ₦0 | ₦0 |
| 5.01-10 km | ₦800 | 20kg | ₦50 | ₦20 |
| 10.01-20 km | ₦1,200 | 30kg | ₦60 | ₦30 |
| 20+ km | ₦1,500 | 50kg | ₦80 | ₦40 |

#### NG-LAGOS Rules (Premium):
| Distance | Flat Payout | Weight Limit | Additional/km | Additional/kg |
|----------|-------------|--------------|---------------|---------------|
| 0-5 km | ₦700 | 10kg | ₦0 | ₦0 |
| 5.01-10 km | ₦1,000 | 20kg | ₦60 | ₦25 |
| 10.01-20 km | ₦1,500 | 30kg | ₦80 | ₦35 |
| 20+ km | ₦2,000 | 50kg | ₦100 | ₦50 |

---

## Testing After Seeding

### Verify Data Was Seeded

```bash
php artisan tinker
```

```php
// Check counts
>>> \App\Models\PricingConfig::count()
=> 3

>>> \App\Models\WeightTier::count()
=> 18

>>> \App\Models\RiderPayoutRule::count()
=> 12

// View active config
>>> \App\Models\PricingConfig::where('is_active', true)->first()
```

### Test Pricing Calculation (Sample from Requirements)

```php
// In tinker
>>> $service = new \App\Services\PricingService('NG-DEFAULT');
>>> $pricing = $service->calculateOrderPricing(4, 40.0, 10.0, 8000.00);

// Check result
>>> $pricing['total_charge']
=> 2950.0  // ✅ Expected: ₦2,950

>>> $pricing['payout_breakdown']['platform_revenue']
=> 1750.0

>>> $pricing['payout_breakdown']['rider_payout']
=> 1200.0

// View full breakdown
>>> print_r($pricing);
```

### Test Different Regions

```php
// Test Lagos pricing (higher rates)
>>> $lagosService = new \App\Services\PricingService('NG-LAGOS');
>>> $lagosPricing = $lagosService->calculateOrderPricing(4, 40.0, 10.0, 8000.00);
>>> $lagosPricing['total_charge']
=> 3950.0  // Higher than default

// Test Abuja pricing
>>> $abujaService = new \App\Services\PricingService('NG-ABUJA');
>>> $abujaPricing = $abujaService->calculateOrderPricing(4, 40.0, 10.0, 8000.00);
>>> $abujaPricing['total_charge']
=> 3330.0  // Between default and Lagos
```

---

## Re-running the Seeder

### Fresh Seed (Clears Old Data)

The seeder automatically clears existing pricing data before seeding new data:

```bash
php artisan db:seed --class=PricingEngineSeeder
```

**⚠️ Warning:** This will delete all existing:
- Pricing configurations
- Weight tiers
- Rider payout rules

### Keep Old Data

If you want to keep existing data, comment out this line in the seeder:

```php
// In PricingEngineSeeder.php, line ~20
// $this->clearExistingData();  // Comment this out
```

Then run:
```bash
php artisan db:seed --class=PricingEngineSeeder
```

---

## Troubleshooting

### Error: "Class 'Database\Seeders\PricingEngineSeeder' not found"

Run:
```bash
composer dump-autoload
php artisan db:seed --class=PricingEngineSeeder
```

### Error: "SQLSTATE[23000]: Integrity constraint violation"

This means data already exists. Either:
1. Let the seeder clear it (default behavior)
2. Or manually clear:
```bash
php artisan tinker
>>> DB::table('rider_payout_rules')->delete();
>>> DB::table('weight_tiers')->delete();
>>> DB::table('pricing_configs')->delete();
>>> exit
php artisan db:seed --class=PricingEngineSeeder
```

### Seeder Runs But No Output

Add verbose flag:
```bash
php artisan db:seed --class=PricingEngineSeeder -v
```

---

## Customizing the Seeder

### Add Your Own Region

Edit `database/seeders/PricingEngineSeeder.php`:

```php
// In seedPricingConfigs() method, add:
[
    'name' => 'Your Region Config',
    'base_charge' => 1700.00,
    'service_charge' => 210.00,
    'charge_per_distance' => 17.00,
    'referral_bonus_percentage' => 5.00,
    'region_id' => 'NG-YOURREGION',
    'is_active' => false,
    'description' => 'Pricing for your region',
    'created_at' => now(),
    'updated_at' => now(),
],

// In seedWeightTiers(), add to $regions array:
'NG-YOURREGION' => 110.00,  // Base service fee

// In seedRiderPayoutRules(), duplicate one of the rule sets
```

### Change Default Values

Edit the arrays in:
- `seedPricingConfigs()` - Change base charges, service charges, etc.
- `seedWeightTiers()` - Change base service fees per region
- `seedRiderPayoutRules()` - Change rider payouts

---

## Sample Seeder Output

```
🚀 Starting Pricing Engine Seeder...
⚠️  Clearing existing pricing data...
✓ Existing data cleared
📊 Seeding Pricing Configurations...
  ✓ Created: Default Nigeria Config (Region: NG-DEFAULT)
  ✓ Created: Lagos Premium Config (Region: NG-LAGOS)
  ✓ Created: Abuja Config (Region: NG-ABUJA)
⚖️  Seeding Weight Tiers...
  Creating tiers for NG-DEFAULT...
  ✓ Created 6 weight tiers for NG-DEFAULT
  Creating tiers for NG-LAGOS...
  ✓ Created 6 weight tiers for NG-LAGOS
  Creating tiers for NG-ABUJA...
  ✓ Created 6 weight tiers for NG-ABUJA
🏍️  Seeding Rider Payout Rules...
  Creating rules for NG-DEFAULT...
  ✓ Created 4 payout rules for NG-DEFAULT
  Creating rules for NG-LAGOS...
  ✓ Created 4 payout rules for NG-LAGOS
  Creating rules for NG-ABUJA...
  ✓ Created 4 payout rules for NG-ABUJA
✅ Pricing Engine seeded successfully!

📋 SEEDING SUMMARY:
  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  📊 Pricing Configs:      3
  ⚖️  Weight Tiers:         18
  🏍️  Rider Payout Rules:  12
  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

🎯 ACTIVE CONFIGURATIONS:
  ✓ Default Nigeria Config (NG-DEFAULT)
    - Base Charge: ₦1,500.00
    - Service Charge: ₦200.00 per item
    - Distance Charge: ₦15.00 per km

🚀 READY TO TEST!
  Run: php artisan tinker
  >>> $service = new \App\Services\PricingService("NG-DEFAULT");
  >>> $pricing = $service->calculateOrderPricing(4, 40.0, 10.0, 8000.00);
  >>> $pricing["total_charge"]
```

---

## Next Steps After Seeding

1. ✅ Test the pricing calculation (see above)
2. ✅ Test API endpoints (see `PRICING_ENGINE_DOCUMENTATION.md`)
3. ✅ Run validation example: `php artisan tinker` then run the validation class
4. ✅ Integrate into your checkout flow (see `PRICING_ENGINE_QUICKSTART.md`)

---

## Quick Commands Reference

```bash
# Seed pricing data
php artisan db:seed --class=PricingEngineSeeder

# Verify seeding
php artisan tinker
>>> \App\Models\PricingConfig::count()

# Test calculation
>>> $service = new \App\Services\PricingService('NG-DEFAULT');
>>> $pricing = $service->calculateOrderPricing(4, 40.0, 10.0, 8000.00);
>>> $pricing['total_charge']

# Clear all pricing data
>>> DB::table('rider_payout_rules')->delete();
>>> DB::table('weight_tiers')->delete();
>>> DB::table('pricing_configs')->delete();

# Re-seed
>>> exit
php artisan db:seed --class=PricingEngineSeeder
```

---

**Happy Testing! 🚀**
