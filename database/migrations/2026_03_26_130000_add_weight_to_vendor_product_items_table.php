<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vendor_product_items', function (Blueprint $table) {
            if (!Schema::hasColumn('vendor_product_items', 'weight')) {
                $table->decimal('weight', 10, 2)->nullable()->after('uom');
            }
        });
    }

    public function down(): void
    {
        Schema::table('vendor_product_items', function (Blueprint $table) {
            if (Schema::hasColumn('vendor_product_items', 'weight')) {
                $table->dropColumn('weight');
            }
        });
    }
};
