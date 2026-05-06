<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '0001_01_01_000000_create_users_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '0001_01_01_000001_create_cache_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '0001_01_01_000002_create_jobs_table',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2024_06_22_123611_create_audit_logs_table',
                'batch' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'migration' => '2024_06_24_102754_create_audit_log_transactions_table',
                'batch' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'migration' => '2024_09_27_221732_create_error_logs_table',
                'batch' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'migration' => '2025_05_29_041916_create_personal_access_tokens_table',
                'batch' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'migration' => '2025_05_29_044032_create_permission_tables',
                'batch' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'migration' => '2025_06_03_042756_create_carts_table',
                'batch' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'migration' => '2025_06_04_032830_add_total_cost_to_carts_table',
                'batch' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'migration' => '2025_06_04_100637_create_shipping_addresses_table',
                'batch' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'migration' => '2025_06_04_110229_create_orders_table',
                'batch' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'migration' => '2025_06_04_110520_create_order_items_table',
                'batch' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'migration' => '2025_06_05_112513_add_details_to_shipping_addresses_table',
                'batch' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'migration' => '2025_06_05_112615_add_payment_status_to_orders_table',
                'batch' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'migration' => '2025_06_05_122514_add_email_to_shipping_addresses_table',
                'batch' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'migration' => '2025_06_05_141213_create_order_status_logs_table',
                'batch' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'migration' => '2025_06_05_145919_create_wishlists_table',
                'batch' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'migration' => '2025_06_06_100246_create_product_reviews_table',
                'batch' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'migration' => '2025_06_08_033124_create_recently_viewed_products_table',
                'batch' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'migration' => '2025_06_17_120612_create_blogs_table',
                'batch' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'migration' => '2025_06_24_085231_add_email_otp_columns_to_users_table',
                'batch' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'migration' => '2025_06_30_233336_add_variant_fields_to_carts_table',
                'batch' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'migration' => '2025_07_01_031805_add_fulfilled_at_to_order_status_logs_table',
                'batch' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'migration' => '2025_07_01_041756_add_variant_snapshot_to_order_items_table',
                'batch' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'migration' => '2025_07_03_152040_make_city_state_nullable_in_shipping_addresses_table',
                'batch' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'migration' => '2025_07_24_022613_add_sendcloud_tracking_to_orders',
                'batch' => 1,
            ),
            27 => 
            array (
                'id' => 29,
                'migration' => '2025_08_12_033202_create_vendor_profiles_table',
                'batch' => 3,
            ),
            28 => 
            array (
                'id' => 30,
                'migration' => '2025_08_09_165602_create_vendor_products_table',
                'batch' => 4,
            ),
            29 => 
            array (
                'id' => 31,
                'migration' => '2025_08_18_044302_create_vendor_product_items_table',
                'batch' => 5,
            ),
            30 => 
            array (
                'id' => 32,
                'migration' => '2025_08_19_051348_add_category_name_and_logo_to_vendor_product_items_table',
                'batch' => 6,
            ),
            31 => 
            array (
                'id' => 33,
                'migration' => '2025_08_27_164842_add_wallets_to_users_table',
                'batch' => 7,
            ),
            32 => 
            array (
                'id' => 34,
                'migration' => '2025_09_01_030705_add_payment_type_to_orders_table',
                'batch' => 8,
            ),
            33 => 
            array (
                'id' => 35,
                'migration' => '2025_09_01_031034_create_transactions_table',
                'batch' => 9,
            ),
            34 => 
            array (
                'id' => 36,
                'migration' => '2025_09_01_033451_add_vendor_order_code_to_orders_table',
                'batch' => 10,
            ),
            35 => 
            array (
                'id' => 37,
                'migration' => '2025_09_01_033552_create_vendor_orders_table',
                'batch' => 10,
            ),
            36 => 
            array (
                'id' => 38,
                'migration' => '2025_09_01_042459_add_installment_to_payment_status_enum',
                'batch' => 11,
            ),
            37 => 
            array (
                'id' => 39,
                'migration' => '2025_09_18_215642_add_vendor_fields_to_users_table',
                'batch' => 12,
            ),
            38 => 
            array (
                'id' => 40,
                'migration' => '2025_10_04_195846_add_status_to_orders_and_order_items',
                'batch' => 13,
            ),
            39 => 
            array (
                'id' => 41,
                'migration' => '2025_10_04_203929_add_lat_lng_to_users_table',
                'batch' => 14,
            ),
            40 => 
            array (
                'id' => 42,
                'migration' => '2025_10_05_151606_add_accepted_by_to_orders_table',
                'batch' => 15,
            ),
            41 => 
            array (
                'id' => 43,
                'migration' => '2025_10_05_161459_add_delivery_address_to_orders_table',
                'batch' => 16,
            ),
            42 => 
            array (
                'id' => 44,
                'migration' => '2026_01_12_195027_add_vehicle_to_users_table',
                'batch' => 17,
            ),
            43 => 
            array (
                'id' => 45,
                'migration' => '2026_01_18_100000_create_pricing_configs_table',
                'batch' => 18,
            ),
            44 => 
            array (
                'id' => 46,
                'migration' => '2026_01_18_100001_create_weight_tiers_table',
                'batch' => 18,
            ),
            45 => 
            array (
                'id' => 47,
                'migration' => '2026_01_18_100002_create_rider_payout_rules_table',
                'batch' => 18,
            ),
            46 => 
            array (
                'id' => 48,
                'migration' => '2026_01_18_100003_add_pricing_fields_to_orders_table',
                'batch' => 18,
            ),
            47 => 
            array (
                'id' => 49,
                'migration' => '2026_01_18_100004_seed_default_pricing_data',
                'batch' => 18,
            ),
            48 => 
            array (
                'id' => 50,
                'migration' => '2026_03_01_161319_create_notifications_table',
                'batch' => 19,
            ),
            49 => 
            array (
                'id' => 51,
                'migration' => '2026_03_16_100000_add_agent_to_user_type_enum',
                'batch' => 20,
            ),
            50 => 
            array (
                'id' => 52,
                'migration' => '2026_03_16_100001_create_agent_bank_details_table',
                'batch' => 20,
            ),
            51 => 
            array (
                'id' => 53,
                'migration' => '2026_03_16_100002_add_referred_by_agent_id_to_users_table',
                'batch' => 20,
            ),
            52 => 
            array (
                'id' => 54,
                'migration' => '2026_03_16_100003_add_agent_id_to_orders_table',
                'batch' => 20,
            ),
            53 => 
            array (
                'id' => 55,
                'migration' => '2026_03_16_100004_create_agent_earnings_table',
                'batch' => 20,
            ),
            54 => 
            array (
                'id' => 56,
                'migration' => '2026_03_16_100005_create_agent_withdrawals_table',
                'batch' => 21,
            ),
            55 => 
            array (
                'id' => 57,
                'migration' => '2026_03_19_100000_restructure_pricing_for_delivery_model',
                'batch' => 22,
            ),
            56 => 
            array (
                'id' => 58,
                'migration' => '2026_03_19_100001_seed_default_delivery_zones',
                'batch' => 22,
            ),
            57 => 
            array (
                'id' => 59,
                'migration' => '2026_03_20_100010_add_service_fee_and_currency_to_pricing_configs',
                'batch' => 23,
            ),
            58 => 
            array (
                'id' => 60,
                'migration' => '2026_03_20_100020_make_max_distance_nullable_on_rider_payout_rules',
                'batch' => 24,
            ),
            59 => 
            array (
                'id' => 61,
                'migration' => '2026_03_26_120000_add_variant_fields_to_vendor_product_items_table',
                'batch' => 25,
            ),
            60 => 
            array (
                'id' => 62,
                'migration' => '2026_03_26_130000_add_weight_to_vendor_product_items_table',
                'batch' => 26,
            ),
            61 => 
            array (
                'id' => 63,
                'migration' => '2026_03_27_120000_add_vendor_price_to_vendor_product_items_table',
                'batch' => 27,
            ),
            62 => 
            array (
                'id' => 64,
                'migration' => '2026_03_27_130000_add_product_markup_percent_to_pricing_configs_table',
                'batch' => 28,
            ),
            63 => 
            array (
                'id' => 65,
                'migration' => '2026_03_28_120000_add_fee_columns_to_orders_table',
                'batch' => 29,
            ),
            64 => 
            array (
                'id' => 66,
                'migration' => '2026_04_02_000001_create_vendor_bank_details_table',
                'batch' => 30,
            ),
            65 => 
            array (
                'id' => 67,
                'migration' => '2026_04_02_000002_create_rider_bank_details_table',
                'batch' => 30,
            ),
            66 => 
            array (
                'id' => 68,
                'migration' => '2026_04_02_000003_create_vendor_payouts_table',
                'batch' => 30,
            ),
            67 => 
            array (
                'id' => 69,
                'migration' => '2026_04_02_000004_create_rider_payouts_table',
                'batch' => 30,
            ),
            68 => 
            array (
                'id' => 70,
                'migration' => '2026_04_03_160000_add_vendor_take_percent_to_pricing_configs_table',
                'batch' => 31,
            ),
            69 => 
            array (
                'id' => 71,
                'migration' => '2026_04_04_100000_add_installment_count_to_orders_table',
                'batch' => 32,
            ),
            70 => 
            array (
                'id' => 72,
                'migration' => '2026_04_05_100000_add_platform_percentage_to_weight_tiers_table',
                'batch' => 33,
            ),
            71 => 
            array (
                'id' => 73,
                'migration' => '2026_04_05_000001_add_custom_amount_to_orders_table',
                'batch' => 34,
            ),
            72 => 
            array (
                'id' => 74,
                'migration' => '2026_04_12_100000_extend_agent_commission_system',
                'batch' => 35,
            ),
            73 => 
            array (
                'id' => 75,
                'migration' => '2026_04_17_131819_create_slides_table',
                'batch' => 36,
            ),
            74 => 
            array (
                'id' => 76,
                'migration' => '2026_04_17_134647_add_url_to_slides_table',
                'batch' => 37,
            ),
            75 => 
            array (
                'id' => 77,
                'migration' => '2026_04_17_151147_make_title_nullable_in_slides_table',
                'batch' => 38,
            ),
        ));
        
        
    }
}