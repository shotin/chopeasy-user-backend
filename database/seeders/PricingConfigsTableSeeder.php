<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PricingConfigsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pricing_configs')->delete();
        
        \DB::table('pricing_configs')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Default Nigeria Config',
                'base_charge' => '1500.00',
                'service_charge' => '0.00',
                'service_fee_percent' => '3.00',
                'product_markup_percent' => '8.00',
                'vendor_take_percent' => '0.00',
                'charge_per_distance' => '0.00',
                'referral_bonus_percentage' => '5.00',
                'region_id' => 'NG-DEFAULT',
                'currency' => 'NGN',
                'is_active' => 0,
                'description' => 'Default pricing configuration for Nigeria',
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-04-03 15:22:15',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Lagos Premium Config',
                'base_charge' => '2000.00',
                'service_charge' => '250.00',
                'service_fee_percent' => '0.00',
                'product_markup_percent' => '8.00',
                'vendor_take_percent' => '0.00',
                'charge_per_distance' => '20.00',
                'referral_bonus_percentage' => '5.00',
                'region_id' => 'NG-LAGOS',
                'currency' => 'NGN',
                'is_active' => 0,
                'description' => 'Premium pricing for Lagos metropolitan area',
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-01-18 08:30:30',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Abuja Config',
                'base_charge' => '1800.00',
                'service_charge' => '220.00',
                'service_fee_percent' => '0.00',
                'product_markup_percent' => '8.00',
                'vendor_take_percent' => '0.00',
                'charge_per_distance' => '18.00',
                'referral_bonus_percentage' => '5.00',
                'region_id' => 'NG-ABUJA',
                'currency' => 'NGN',
                'is_active' => 0,
                'description' => 'Pricing configuration for Abuja',
                'created_at' => '2026-01-18 08:30:30',
                'updated_at' => '2026-01-18 08:30:30',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 6,
                'name' => 'Default Config',
                'base_charge' => '1500.00',
                'service_charge' => '0.00',
                'service_fee_percent' => '3.00',
                'product_markup_percent' => '4.00',
                'vendor_take_percent' => '3.00',
                'charge_per_distance' => '0.00',
                'referral_bonus_percentage' => '0.00',
                'region_id' => 'NG-DEFAULT',
                'currency' => 'NGN',
                'is_active' => 1,
                'description' => NULL,
                'created_at' => '2026-04-03 15:22:15',
                'updated_at' => '2026-04-04 12:40:43',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}