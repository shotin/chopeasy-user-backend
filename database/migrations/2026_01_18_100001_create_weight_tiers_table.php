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
        Schema::create('weight_tiers', function (Blueprint $table) {
            $table->id();
            $table->decimal('min_weight', 8, 2)->comment('Minimum weight in kg');
            $table->decimal('max_weight', 8, 2)->comment('Maximum weight in kg');
            $table->integer('multiplier')->comment('Multiplier for base service fee');
            $table->decimal('base_service_fee', 10, 2)->comment('Base fee for 1kg-5kg range');
            $table->string('region_id')->nullable()->index()->comment('Region identifier');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Ensure no overlapping weight ranges per region
            $table->index(['region_id', 'min_weight', 'max_weight']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weight_tiers');
    }
};
