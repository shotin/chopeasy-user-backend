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
        Schema::create('rider_payout_rules', function (Blueprint $table) {
            $table->id();
            $table->decimal('max_distance', 8, 2)->comment('Maximum distance in km for this rule');
            $table->decimal('flat_payout', 10, 2)->comment('Flat payout amount to rider');
            $table->decimal('weight_limit', 8, 2)->nullable()->comment('Weight limit for this payout rule');
            $table->decimal('additional_per_km', 10, 2)->default(0)->comment('Additional charge per km beyond base');
            $table->decimal('additional_per_kg', 10, 2)->default(0)->comment('Additional charge per kg beyond base');
            $table->string('region_id')->nullable()->index();
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0)->comment('Rule priority for matching');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rider_payout_rules');
    }
};
