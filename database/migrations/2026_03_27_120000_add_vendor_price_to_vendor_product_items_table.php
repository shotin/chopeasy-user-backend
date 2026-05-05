<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vendor_product_items', function (Blueprint $table) {
            if (!Schema::hasColumn('vendor_product_items', 'vendor_price')) {
                $table->decimal('vendor_price', 12, 2)
                    ->nullable()
                    ->after('price');
            }
        });

        DB::table('vendor_product_items')
            ->select('id', 'price')
            ->orderBy('id')
            ->chunkById(100, function ($items) {
                foreach ($items as $item) {
                    DB::table('vendor_product_items')
                        ->where('id', $item->id)
                        ->update([
                            'vendor_price' => $item->price,
                        ]);
                }
            });
    }

    public function down(): void
    {
        Schema::table('vendor_product_items', function (Blueprint $table) {
            if (Schema::hasColumn('vendor_product_items', 'vendor_price')) {
                $table->dropColumn('vendor_price');
            }
        });
    }
};
