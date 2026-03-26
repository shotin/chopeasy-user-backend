<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE rider_payout_rules MODIFY max_distance DECIMAL(8,2) NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE rider_payout_rules MODIFY max_distance DECIMAL(8,2) NOT NULL');
    }
};
