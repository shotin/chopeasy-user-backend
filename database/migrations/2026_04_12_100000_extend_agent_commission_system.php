<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agent_commission_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('customer_percent', 5, 2)->default(10);
            $table->decimal('vendor_percent', 5, 2)->default(10);
            $table->decimal('rider_percent', 5, 2)->default(10);
            $table->unsignedTinyInteger('max_vendor_rider_payout_commissions')->default(5);
            $table->timestamps();
        });

        Schema::table('agent_earnings', function (Blueprint $table) {
            $table->string('earning_type', 32)->default('customer_order')->after('order_id');
            $table->foreignId('referred_user_id')->nullable()->after('earning_type')->constrained('users')->nullOnDelete();
            $table->foreignId('withdrawal_id')->nullable()->after('status')->constrained('agent_withdrawals')->nullOnDelete();
            $table->index(['agent_id', 'earning_type']);
            $table->index(['withdrawal_id']);
        });

        Schema::create('agent_referral_commission_counters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('referred_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('referral_kind', 16); // vendor | rider
            $table->unsignedInteger('payout_count')->default(0);
            $table->timestamps();
            $table->unique(['agent_id', 'referred_user_id', 'referral_kind'], 'agent_ref_user_kind_unique');
        });

        Schema::create('agent_withdrawal_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_withdrawal_id')->constrained('agent_withdrawals')->cascadeOnDelete();
            $table->foreignId('agent_earning_id')->constrained('agent_earnings')->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->string('order_number')->nullable();
            $table->string('earning_type', 32)->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('onboarding_completed')->default(true);
        });

        Schema::create('agent_customer_notification_prefs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('customer_user_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('notify_inactive')->default(false);
            $table->boolean('notify_incomplete_onboarding')->default(false);
            $table->timestamps();
            $table->unique(['agent_id', 'customer_user_id'], 'agent_customer_pref_unique');
        });

        DB::table('agent_commission_settings')->insert([
            'customer_percent' => 10,
            'vendor_percent' => 10,
            'rider_percent' => 10,
            'max_vendor_rider_payout_commissions' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('agent_customer_notification_prefs');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('onboarding_completed');
        });
        Schema::dropIfExists('agent_withdrawal_lines');
        Schema::dropIfExists('agent_referral_commission_counters');
        Schema::table('agent_earnings', function (Blueprint $table) {
            $table->dropForeign(['referred_user_id']);
            $table->dropForeign(['withdrawal_id']);
            $table->dropColumn(['earning_type', 'referred_user_id', 'withdrawal_id']);
        });
        Schema::dropIfExists('agent_commission_settings');
    }
};
