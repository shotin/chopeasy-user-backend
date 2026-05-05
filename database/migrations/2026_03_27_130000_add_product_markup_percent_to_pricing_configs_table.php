<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pricing_configs', function (Blueprint $table) {
            if (!Schema::hasColumn('pricing_configs', 'product_markup_percent')) {
                $table->decimal('product_markup_percent', 5, 2)
                    ->default(8)
                    ->after('service_fee_percent');
            }
        });

        DB::table('pricing_configs')
            ->whereNull('product_markup_percent')
            ->update(['product_markup_percent' => 8]);
    }

    public function down(): void
    {
        Schema::table('pricing_configs', function (Blueprint $table) {
            if (Schema::hasColumn('pricing_configs', 'product_markup_percent')) {
                $table->dropColumn('product_markup_percent');
            }
        });
    }
};
