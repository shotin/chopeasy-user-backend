<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PasswordResetTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('password_reset_tokens')->delete();
        
        \DB::table('password_reset_tokens')->insert(array (
            0 => 
            array (
                'email' => 'ilesanmiolushola9@gmail.com',
                'token' => '$2y$12$SrF2anBwBNDRmuTrD6TknuUXw3.GDf.27obv.St2e7sehHt6/99iG',
                'created_at' => '2025-11-05 03:22:13',
            ),
        ));
        
        
    }
}