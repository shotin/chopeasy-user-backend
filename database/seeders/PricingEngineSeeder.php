<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PricingConfig;
use App\Models\WeightTier;
use App\Models\RiderPayoutRule;

class PricingEngineSeeder extends Seeder
{
    /**
     * Seed the pricing engine with default data.
     * 
     * Run with: php artisan db:seed --class=PricingEngineSeeder
     */
    public function run(): void
    {
        $this->command->info('🚀 Starting Pricing Engine Seeder...');

        // Clear existing data (optional - comment out if you want to keep existing data)
        $this->clearExistingData();

        // Seed pricing configurations
        $this->seedPricingConfigs();

        // Seed weight tiers
        $this->seedWeightTiers();

        // Seed rider payout rules
        $this->seedRiderPayoutRules();

        $this->command->info('✅ Pricing Engine seeded successfully!');
        $this->displaySummary();
    }

    /**
     * Clear existing pricing data
     */
    private function clearExistingData(): void
    {
        $this->command->warn('⚠️  Clearing existing pricing data...');
        
        DB::table('rider_payout_rules')->delete();
        DB::table('weight_tiers')->delete();
        DB::table('pricing_configs')->delete();
        
        $this->command->info('✓ Existing data cleared');
    }

    /**
     * Seed pricing configurations
     */
    private function seedPricingConfigs(): void
    {
        $this->command->info('📊 Seeding Pricing Configurations...');

        $configs = [
            [
                'name' => 'Default Nigeria Config',
                'base_charge' => 1500.00,
                'service_charge' => 200.00,
                'charge_per_distance' => 15.00,
                'referral_bonus_percentage' => 5.00,
                'region_id' => 'NG-DEFAULT',
                'is_active' => true,
                'description' => 'Default pricing configuration for Nigeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lagos Premium Config',
                'base_charge' => 2000.00,
                'service_charge' => 250.00,
                'charge_per_distance' => 20.00,
                'referral_bonus_percentage' => 5.00,
                'region_id' => 'NG-LAGOS',
                'is_active' => false, // Inactive by default
                'description' => 'Premium pricing for Lagos metropolitan area',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Abuja Config',
                'base_charge' => 1800.00,
                'service_charge' => 220.00,
                'charge_per_distance' => 18.00,
                'referral_bonus_percentage' => 5.00,
                'region_id' => 'NG-ABUJA',
                'is_active' => false, // Inactive by default
                'description' => 'Pricing configuration for Abuja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($configs as $config) {
            PricingConfig::create($config);
            $this->command->line("  ✓ Created: {$config['name']} (Region: {$config['region_id']})");
        }
    }

    /**
     * Seed weight tiers for each region
     */
    private function seedWeightTiers(): void
    {
        $this->command->info('⚖️  Seeding Weight Tiers...');

        // Weight tiers structure (same for all regions)
        $tierStructure = [
            ['min_weight' => 1.00, 'max_weight' => 5.00, 'multiplier' => 1],
            ['min_weight' => 5.01, 'max_weight' => 10.00, 'multiplier' => 2],
            ['min_weight' => 10.01, 'max_weight' => 20.00, 'multiplier' => 3],
            ['min_weight' => 20.01, 'max_weight' => 30.00, 'multiplier' => 4],
            ['min_weight' => 30.01, 'max_weight' => 40.00, 'multiplier' => 5],
            ['min_weight' => 40.01, 'max_weight' => 50.00, 'multiplier' => 6],
        ];

        // Regions and their base service fees
        $regions = [
            'NG-DEFAULT' => 100.00,
            'NG-LAGOS' => 150.00,
            'NG-ABUJA' => 120.00,
        ];

        foreach ($regions as $regionId => $baseServiceFee) {
            $this->command->line("  Creating tiers for {$regionId}...");
            
            foreach ($tierStructure as $tier) {
                WeightTier::create([
                    'min_weight' => $tier['min_weight'],
                    'max_weight' => $tier['max_weight'],
                    'multiplier' => $tier['multiplier'],
                    'base_service_fee' => $baseServiceFee,
                    'region_id' => $regionId,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            $this->command->line("  ✓ Created 6 weight tiers for {$regionId}");
        }
    }

    /**
     * Seed rider payout rules
     */
    private function seedRiderPayoutRules(): void
    {
        $this->command->info('🏍️  Seeding Rider Payout Rules...');

        // Default region rules
        $defaultRules = [
            [
                'max_distance' => 5.00,
                'flat_payout' => 500.00,
                'weight_limit' => 10.00,
                'additional_per_km' => 0.00,
                'additional_per_kg' => 0.00,
                'priority' => 1,
                'description' => 'Short distance, light weight',
            ],
            [
                'max_distance' => 10.00,
                'flat_payout' => 800.00,
                'weight_limit' => 20.00,
                'additional_per_km' => 50.00,
                'additional_per_kg' => 20.00,
                'priority' => 2,
                'description' => 'Medium distance, medium weight',
            ],
            [
                'max_distance' => 20.00,
                'flat_payout' => 1200.00,
                'weight_limit' => 30.00,
                'additional_per_km' => 60.00,
                'additional_per_kg' => 30.00,
                'priority' => 3,
                'description' => 'Long distance, heavy weight',
            ],
            [
                'max_distance' => 999.00,
                'flat_payout' => 1500.00,
                'weight_limit' => 50.00,
                'additional_per_km' => 80.00,
                'additional_per_kg' => 40.00,
                'priority' => 4,
                'description' => 'Very long distance, very heavy weight',
            ],
        ];

        // Lagos premium rules (higher payouts)
        $lagosRules = [
            [
                'max_distance' => 5.00,
                'flat_payout' => 700.00,
                'weight_limit' => 10.00,
                'additional_per_km' => 0.00,
                'additional_per_kg' => 0.00,
                'priority' => 1,
                'description' => 'Lagos - Short distance',
            ],
            [
                'max_distance' => 10.00,
                'flat_payout' => 1000.00,
                'weight_limit' => 20.00,
                'additional_per_km' => 60.00,
                'additional_per_kg' => 25.00,
                'priority' => 2,
                'description' => 'Lagos - Medium distance',
            ],
            [
                'max_distance' => 20.00,
                'flat_payout' => 1500.00,
                'weight_limit' => 30.00,
                'additional_per_km' => 80.00,
                'additional_per_kg' => 35.00,
                'priority' => 3,
                'description' => 'Lagos - Long distance',
            ],
            [
                'max_distance' => 999.00,
                'flat_payout' => 2000.00,
                'weight_limit' => 50.00,
                'additional_per_km' => 100.00,
                'additional_per_kg' => 50.00,
                'priority' => 4,
                'description' => 'Lagos - Very long distance',
            ],
        ];

        // Seed NG-DEFAULT rules
        $this->command->line("  Creating rules for NG-DEFAULT...");
        foreach ($defaultRules as $rule) {
            $description = $rule['description'];
            unset($rule['description']);
            
            RiderPayoutRule::create(array_merge($rule, [
                'region_id' => 'NG-DEFAULT',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
        $this->command->line("  ✓ Created 4 payout rules for NG-DEFAULT");

        // Seed NG-LAGOS rules
        $this->command->line("  Creating rules for NG-LAGOS...");
        foreach ($lagosRules as $rule) {
            $description = $rule['description'];
            unset($rule['description']);
            
            RiderPayoutRule::create(array_merge($rule, [
                'region_id' => 'NG-LAGOS',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
        $this->command->line("  ✓ Created 4 payout rules for NG-LAGOS");

        // Seed NG-ABUJA rules (same as default)
        $this->command->line("  Creating rules for NG-ABUJA...");
        foreach ($defaultRules as $rule) {
            $description = $rule['description'];
            unset($rule['description']);
            
            RiderPayoutRule::create(array_merge($rule, [
                'region_id' => 'NG-ABUJA',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
        $this->command->line("  ✓ Created 4 payout rules for NG-ABUJA");
    }

    /**
     * Display summary of seeded data
     */
    private function displaySummary(): void
    {
        $this->command->newLine();
        $this->command->info('📋 SEEDING SUMMARY:');
        $this->command->line('  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        
        $configCount = PricingConfig::count();
        $tierCount = WeightTier::count();
        $ruleCount = RiderPayoutRule::count();
        
        $this->command->line("  📊 Pricing Configs:      {$configCount}");
        $this->command->line("  ⚖️  Weight Tiers:         {$tierCount}");
        $this->command->line("  🏍️  Rider Payout Rules:  {$ruleCount}");
        $this->command->line('  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        
        $this->command->newLine();
        $this->command->info('🎯 ACTIVE CONFIGURATIONS:');
        
        $activeConfigs = PricingConfig::where('is_active', true)->get();
        foreach ($activeConfigs as $config) {
            $this->command->line("  ✓ {$config->name} ({$config->region_id})");
            $this->command->line("    - Base Charge: ₦" . number_format($config->base_charge, 2));
            $this->command->line("    - Service Charge: ₦" . number_format($config->service_charge, 2) . " per item");
            $this->command->line("    - Distance Charge: ₦" . number_format($config->charge_per_distance, 2) . " per km");
        }
        
        $this->command->newLine();
        $this->command->info('🚀 READY TO TEST!');
        $this->command->line('  Run: php artisan tinker');
        $this->command->line('  >>> $service = new \App\Services\PricingService("NG-DEFAULT");');
        $this->command->line('  >>> $pricing = $service->calculateOrderPricing(4, 40.0, 10.0, 8000.00);');
        $this->command->line('  >>> $pricing["total_charge"]');
        $this->command->newLine();
    }
}
