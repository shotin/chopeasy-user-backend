<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert default pricing config
        DB::table('pricing_configs')->insert([
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
        ]);

        // Insert weight tiers (1kg - 50kg)
        $weightTiers = [
            ['min_weight' => 1.00, 'max_weight' => 5.00, 'multiplier' => 1, 'base_service_fee' => 100.00],
            ['min_weight' => 5.01, 'max_weight' => 10.00, 'multiplier' => 2, 'base_service_fee' => 100.00],
            ['min_weight' => 10.01, 'max_weight' => 20.00, 'multiplier' => 3, 'base_service_fee' => 100.00],
            ['min_weight' => 20.01, 'max_weight' => 30.00, 'multiplier' => 4, 'base_service_fee' => 100.00],
            ['min_weight' => 30.01, 'max_weight' => 40.00, 'multiplier' => 5, 'base_service_fee' => 100.00],
            ['min_weight' => 40.01, 'max_weight' => 50.00, 'multiplier' => 6, 'base_service_fee' => 100.00],
        ];

        foreach ($weightTiers as $tier) {
            DB::table('weight_tiers')->insert([
                'min_weight' => $tier['min_weight'],
                'max_weight' => $tier['max_weight'],
                'multiplier' => $tier['multiplier'],
                'base_service_fee' => $tier['base_service_fee'],
                'region_id' => 'NG-DEFAULT',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert default rider payout rules
        $riderRules = [
            [
                'max_distance' => 5.00,
                'flat_payout' => 500.00,
                'weight_limit' => 10.00,
                'additional_per_km' => 0,
                'additional_per_kg' => 0,
                'priority' => 1,
            ],
            [
                'max_distance' => 10.00,
                'flat_payout' => 800.00,
                'weight_limit' => 20.00,
                'additional_per_km' => 50.00,
                'additional_per_kg' => 20.00,
                'priority' => 2,
            ],
            [
                'max_distance' => 20.00,
                'flat_payout' => 1200.00,
                'weight_limit' => 30.00,
                'additional_per_km' => 60.00,
                'additional_per_kg' => 30.00,
                'priority' => 3,
            ],
            [
                'max_distance' => 999.00, // Catch-all for longer distances
                'flat_payout' => 1500.00,
                'weight_limit' => 50.00,
                'additional_per_km' => 80.00,
                'additional_per_kg' => 40.00,
                'priority' => 4,
            ],
        ];

        foreach ($riderRules as $rule) {
            DB::table('rider_payout_rules')->insert([
                'max_distance' => $rule['max_distance'],
                'flat_payout' => $rule['flat_payout'],
                'weight_limit' => $rule['weight_limit'],
                'additional_per_km' => $rule['additional_per_km'],
                'additional_per_kg' => $rule['additional_per_kg'],
                'region_id' => 'NG-DEFAULT',
                'is_active' => true,
                'priority' => $rule['priority'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('pricing_configs')->where('region_id', 'NG-DEFAULT')->delete();
        DB::table('weight_tiers')->where('region_id', 'NG-DEFAULT')->delete();
        DB::table('rider_payout_rules')->where('region_id', 'NG-DEFAULT')->delete();
    }
};
