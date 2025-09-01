<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('vendor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->text('description')->nullable()->comment('Vendor description, e.g., "Fresh produce and organic groceries"');
            $table->string('store_type')->nullable()->comment('Type of store, e.g., "Grocery Store"');
            $table->string('delivery_time')->nullable()->comment('Estimated delivery time, e.g., "15-30 min"');
            $table->string('logo')->nullable()->comment('Path or URL to vendor logo');
            $table->decimal('latitude', 10, 8)->nullable()->comment('Vendor location latitude');
            $table->decimal('longitude', 11, 8)->nullable()->comment('Vendor location longitude');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendor_profiles');
    }
}