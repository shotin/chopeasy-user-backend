<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('status')->default('pending');
            $table->string('bank_name')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('recipient_code')->nullable();
            $table->string('transfer_code')->nullable();
            $table->string('transfer_reference')->nullable();
            $table->text('failure_reason')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->unique(['vendor_id', 'order_id']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_payouts');
    }
};
