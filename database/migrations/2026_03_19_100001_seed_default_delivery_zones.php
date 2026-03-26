<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Seed default distance zones for NG-DEFAULT region
     * Zone A: 0–5 km → ₦0
     * Zone B: 5–10 km → ₦500
     * Zone C: 10–15 km → ₦1,000
     * Zone D: 15–20 km → ₦1,500
     * Zone E: 20–25 km → ₦2,000
     */
    public function up(): void
    {
        $zones = [
            ['zone_name' => 'Zone A', 'min_distance' => 0, 'max_distance' => 5, 'flat_payout' => 0],
            ['zone_name' => 'Zone B', 'min_distance' => 5, 'max_distance' => 10, 'flat_payout' => 500],
            ['zone_name' => 'Zone C', 'min_distance' => 10, 'max_distance' => 15, 'flat_payout' => 1000],
            ['zone_name' => 'Zone D', 'min_distance' => 15, 'max_distance' => 20, 'flat_payout' => 1500],
            ['zone_name' => 'Zone E', 'min_distance' => 20, 'max_distance' => 25, 'flat_payout' => 2000],
        ];

        DB::table('rider_payout_rules')->where('region_id', 'NG-DEFAULT')->delete();

        foreach ($zones as $i => $zone) {
            DB::table('rider_payout_rules')->insert(array_merge($zone, [
                'region_id' => 'NG-DEFAULT',
                'is_active' => true,
                'priority' => $i + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        DB::table('weight_tiers')->where('region_id', 'NG-DEFAULT')->update([
            'price_per_kg' => 90,
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('rider_payout_rules')->where('region_id', 'NG-DEFAULT')->delete();
    }
};
