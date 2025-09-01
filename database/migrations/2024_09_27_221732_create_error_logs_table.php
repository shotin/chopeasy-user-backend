<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('error_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('causer')->nullable();
            $table->string('model')->nullable();
            $table->text('error_message');
            $table->string('error_line')->nullable();
            $table->longText('error_trace')->nullable();
            $table->string('request_url')->nullable();
            $table->string('request_method')->nullable();
            $table->json('request_data')->nullable(); //text
            $table->ipAddress('request_ip')->nullable(); //string
            $table->string('user_agent')->nullable();
            $table->json('context')->nullable(); // Define context as a JSON column
            $table->timestamps();

            $table->index('model');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error_logs');
    }

    //Supporting SQL
    //     ALTER TABLE `error_logs`
    // ADD COLUMN `request_url` VARCHAR(255) NULL AFTER `error_trace`,
    // ADD COLUMN `request_method` VARCHAR(255) NULL AFTER `request_url`,
    // ADD COLUMN `request_data` TEXT NULL AFTER `request_method`,
    // ADD COLUMN `request_ip` VARCHAR(255) NULL AFTER `request_data`,
    // ADD COLUMN `user_agent` VARCHAR(255) NULL AFTER `request_ip`,
    // ADD COLUMN `context` JSON NULL AFTER `user_agent`;
};
