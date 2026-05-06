<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AuditLogTransactionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('audit_log_transactions')->delete();
     
        
        
    }
}