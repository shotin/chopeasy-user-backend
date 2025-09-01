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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('middlename')->nullable();
            $table->string('guardianname')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('phoneno')->nullable();
            $table->string('address')->nullable();
            $table->string('lga')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('gender')->nullable();
            $table->text('image')->nullable();
            $table->text('cover_photo')->nullable();
            $table->date('date_of_birth')->nullable();
             $table->enum('user_type', ['customer', 'vendor', 'rider']);

            // Activity Fields
            $table->timestamp('last_login')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->longText('fcm_token')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('continent')->nullable();

            $table->boolean('is_verified')->default(false)->comment('User email verified status');
            $table->boolean('is_active')->default(true)->comment('User active status');
            $table->boolean('is_default')->default(false)->comment('Is default user');
            $table->boolean('can_login')->default(false)->comment('User can login status');
            $table->boolean('two_fa')->default(false)->comment('Two-factor authentication enabled');

            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
