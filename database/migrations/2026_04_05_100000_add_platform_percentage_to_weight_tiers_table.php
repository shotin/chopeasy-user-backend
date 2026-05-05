<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('weight_tiers', function (Blueprint $table) {
            $table->decimal('platform_percentage', 5, 2)
                ->default(0)
                ->after('price_per_kg')
                ->comment('Platform take % of weight fee; rider gets the remainder + distance fee');
        });
    }

    public function down(): void
    {
        Schema::table('weight_tiers', function (Blueprint $table) {
            $table->dropColumn('platform_percentage');
        });
    }
};
