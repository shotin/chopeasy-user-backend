<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('main_wallet', 15, 2)->default(0)->after('email'); // store balance in Naira
            $table->decimal('food_wallet', 15, 2)->default(0)->after('main_wallet');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['main_wallet', 'food_wallet']);
        });
    }
};
