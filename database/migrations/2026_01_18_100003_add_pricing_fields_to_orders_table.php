<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Order metrics
            $table->decimal('total_weight', 8, 2)->nullable()->after('total_amount')->comment('Total weight in kg');
            $table->integer('item_count')->nullable()->after('total_weight')->comment('Total item quantity');
            $table->decimal('distance_in_km', 8, 2)->nullable()->after('item_count')->comment('Delivery distance');
            
            // Pricing breakdown
            $table->decimal('computed_total_charge', 10, 2)->nullable()->after('distance_in_km')->comment('Total calculated charge');
            $table->decimal('platform_revenue', 10, 2)->nullable()->after('computed_total_charge')->comment('Platform profit');
            $table->decimal('rider_payout', 10, 2)->nullable()->after('platform_revenue')->comment('Amount paid to rider');
            $table->decimal('vendor_payout', 10, 2)->nullable()->after('rider_payout')->comment('Amount paid to vendor');
            
            // Pricing config reference
            $table->foreignId('pricing_config_id')->nullable()->after('vendor_payout')->constrained('pricing_configs')->onDelete('set null');
            $table->foreignId('weight_tier_id')->nullable()->after('pricing_config_id')->constrained('weight_tiers')->onDelete('set null');
            
            // Pricing breakdown snapshot (for audit trail)
            $table->json('pricing_breakdown')->nullable()->after('weight_tier_id')->comment('Detailed pricing calculation snapshot');
            
            // Coordinates
            $table->decimal('pickup_latitude', 10, 8)->nullable()->after('pricing_breakdown');
            $table->decimal('pickup_longitude', 11, 8)->nullable()->after('pickup_latitude');
            $table->decimal('delivery_latitude', 10, 8)->nullable()->after('pickup_longitude');
            $table->decimal('delivery_longitude', 11, 8)->nullable()->after('delivery_latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['pricing_config_id']);
            $table->dropForeign(['weight_tier_id']);
            
            $table->dropColumn([
                'total_weight',
                'item_count',
                'distance_in_km',
                'computed_total_charge',
                'platform_revenue',
                'rider_payout',
                'vendor_payout',
                'pricing_config_id',
                'weight_tier_id',
                'pricing_breakdown',
                'pickup_latitude',
                'pickup_longitude',
                'delivery_latitude',
                'delivery_longitude',
            ]);
        });
    }
};
