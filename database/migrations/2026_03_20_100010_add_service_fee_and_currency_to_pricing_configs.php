<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pricing_configs', function (Blueprint $table) {
            if (!Schema::hasColumn('pricing_configs', 'service_fee_percent')) {
                $table->decimal('service_fee_percent', 5, 2)->default(0)->after('service_charge')
                    ->comment('Service fee percentage applied to vendor subtotal');
            }
            if (!Schema::hasColumn('pricing_configs', 'currency')) {
                $table->string('currency', 10)->default('NGN')->after('region_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pricing_configs', function (Blueprint $table) {
            if (Schema::hasColumn('pricing_configs', 'service_fee_percent')) {
                $table->dropColumn('service_fee_percent');
            }
            if (Schema::hasColumn('pricing_configs', 'currency')) {
                $table->dropColumn('currency');
            }
        });
    }
};
