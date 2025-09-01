<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('payment_type', ['outright', 'daily', 'weekly', 'monthly'])->default('outright')->after('total_amount');
            $table->decimal('amount_paid', 12, 2)->default(0)->after('payment_type');
            $table->decimal('remaining_amount', 12, 2)->default(0)->after('amount_paid');
            $table->timestamp('next_due_date')->nullable()->after('remaining_amount');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_type', 'amount_paid', 'remaining_amount', 'next_due_date']);
        });
    }
};
