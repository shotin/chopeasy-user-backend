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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->nullable()->constrained()->cascadeOnDelete();
            $table->enum('type', ['deposit', 'deduction', 'transfer'])->index();
            $table->enum('source_wallet', ['main_wallet', 'food_wallet'])->nullable();
            $table->enum('destination_wallet', ['main_wallet', 'food_wallet'])->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('reference')->nullable()->index();
            $table->string('status')->default('successful'); // or failed
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
