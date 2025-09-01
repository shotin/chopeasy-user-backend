<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
      public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->json('variant_snapshot')->nullable()->after('product_snapshot');
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['product_variant_id', 'variant_snapshot']);
        });
    }
};
