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
        Schema::table('vendor_product_items', function (Blueprint $table) {
            if (!Schema::hasColumn('vendor_product_items', 'product_variant_id')) {
                $table->unsignedBigInteger('product_variant_id')->nullable()->after('product_id');
            }

            if (!Schema::hasColumn('vendor_product_items', 'display_name')) {
                $table->string('display_name')->nullable()->after('name');
            }

            if (!Schema::hasColumn('vendor_product_items', 'variant_label')) {
                $table->string('variant_label')->nullable()->after('display_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_product_items', function (Blueprint $table) {
            if (Schema::hasColumn('vendor_product_items', 'variant_label')) {
                $table->dropColumn('variant_label');
            }

            if (Schema::hasColumn('vendor_product_items', 'display_name')) {
                $table->dropColumn('display_name');
            }

            if (Schema::hasColumn('vendor_product_items', 'product_variant_id')) {
                $table->dropColumn('product_variant_id');
            }
        });
    }
};
