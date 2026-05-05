<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rider_bank_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('bank_name');
            $table->string('bank_code');
            $table->string('account_number');
            $table->string('account_name');
            $table->string('recipient_code')->nullable();
            $table->timestamps();

            $table->unique('user_id');
        });

        if (Schema::hasTable('agent_bank_details')) {
            $riderRows = DB::table('agent_bank_details')
                ->join('users', 'users.id', '=', 'agent_bank_details.user_id')
                ->where('users.user_type', 'rider')
                ->select([
                    'agent_bank_details.user_id',
                    'agent_bank_details.bank_name',
                    'agent_bank_details.bank_code',
                    'agent_bank_details.account_number',
                    'agent_bank_details.account_name',
                    'agent_bank_details.created_at',
                    'agent_bank_details.updated_at',
                ])
                ->get()
                ->map(fn ($row) => (array) $row)
                ->all();

            if (!empty($riderRows)) {
                DB::table('rider_bank_details')->insert($riderRows);

                DB::table('agent_bank_details')
                    ->whereIn('user_id', array_column($riderRows, 'user_id'))
                    ->delete();
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('rider_bank_details');
    }
};
