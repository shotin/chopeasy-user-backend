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
        Schema::create('pricing_configs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Configuration name for reference');
            $table->decimal('base_charge', 10, 2)->comment('Fixed platform charge per order');
            $table->decimal('service_charge', 10, 2)->comment('Charge per item unit');
            $table->decimal('charge_per_distance', 10, 2)->comment('Cost per kilometer');
            $table->decimal('referral_bonus_percentage', 5, 2)->default(0)->comment('Referral bonus percentage');
            $table->string('region_id')->nullable()->index()->comment('Region identifier for multi-region support');
            $table->boolean('is_active')->default(true)->comment('Active status of this config');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Only one active config per region
            $table->unique(['region_id', 'is_active'], 'unique_active_region');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_configs');
    }
};
