<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Restructure pricing for new delivery model:
     * Delivery Fee = Base Fee + (Weight Fee = weight × price_per_kg) + Distance Fee (zone-based)
     */
    public function up(): void
    {
        // Weight tiers: add price_per_kg (₦90/kg - simple rate)
        Schema::table('weight_tiers', function (Blueprint $table) {
            $table->decimal('price_per_kg', 10, 2)->default(90)->after('base_service_fee')
                ->comment('Price per kg for weight fee calculation');
        });

        // Rider payout rules = Distance zones: min_distance, zone_name (flat_payout = zone fee)
        Schema::table('rider_payout_rules', function (Blueprint $table) {
            $table->decimal('min_distance', 8, 2)->default(0)->after('id')
                ->comment('Min distance in km for this zone');
            $table->string('zone_name', 50)->nullable()->after('min_distance')
                ->comment('Zone label e.g. Zone A, Zone B');
        });
    }

    public function down(): void
    {
        Schema::table('weight_tiers', function (Blueprint $table) {
            $table->dropColumn('price_per_kg');
        });

        Schema::table('rider_payout_rules', function (Blueprint $table) {
            $table->dropColumn(['min_distance', 'zone_name']);
        });
    }
};
