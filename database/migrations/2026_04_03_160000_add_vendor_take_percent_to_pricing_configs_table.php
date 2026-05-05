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
            if (!Schema::hasColumn('pricing_configs', 'vendor_take_percent')) {
                $table->decimal('vendor_take_percent', 5, 2)
                    ->default(0)
                    ->after('product_markup_percent');
            }
        });

        DB::table('pricing_configs')
            ->whereNull('vendor_take_percent')
            ->update(['vendor_take_percent' => 0]);
    }

    public function down(): void
    {
        Schema::table('pricing_configs', function (Blueprint $table) {
            if (Schema::hasColumn('pricing_configs', 'vendor_take_percent')) {
                $table->dropColumn('vendor_take_percent');
            }
        });
    }
};
