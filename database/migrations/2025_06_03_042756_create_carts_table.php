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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            $table->string('session_id')->nullable()->index();

            $table->unsignedBigInteger('product_id');

            $table->unsignedBigInteger('product_variant_id')->nullable();

            $table->unsignedInteger('quantity')->default(1);

            $table->decimal('price_at_addition', 10, 2)->nullable();

            $table->json('product_snapshot')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'product_id', 'product_variant_id']);
            $table->unique(['session_id', 'product_id', 'product_variant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
