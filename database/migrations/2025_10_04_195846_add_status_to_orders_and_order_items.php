<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ✅ Make sure ENUM values are unique
        DB::statement("ALTER TABLE orders MODIFY status ENUM('pending', 'ongoing', 'ready', 'delivered', 'cancelled') NULL");

        // ✅ Add status to order_items
        Schema::table('order_items', function (Blueprint $table) {
            $table->enum('status', ['pending', 'ready'])
                  ->nullable()
                  ->default(null)
                  ->after('price_at_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback orders.status to old values (remove `ready`)
        DB::statement("ALTER TABLE orders MODIFY status ENUM('pending', 'ongoing', 'delivered', 'cancelled') NULL");

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
