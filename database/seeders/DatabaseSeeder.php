<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            // UserSeeder::class,
            
            // Pricing Engine (uncomment to seed pricing data)
            // PricingEngineSeeder::class,
        ]);
        $this->call(UsersTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderItemsTableSeeder::class);
        $this->call(OrderStatusLogsTableSeeder::class);
        $this->call(AgentBankDetailsTableSeeder::class);
        $this->call(AgentCommissionSettingsTableSeeder::class);
        $this->call(AgentCustomerNotificationPrefsTableSeeder::class);
        $this->call(AgentEarningsTableSeeder::class);
        $this->call(AgentReferralCommissionCountersTableSeeder::class);
        $this->call(AgentWithdrawalsTableSeeder::class);
        $this->call(AgentWithdrawalLinesTableSeeder::class);
        $this->call(AuditLogsTableSeeder::class);
        $this->call(AuditLogTransactionsTableSeeder::class);
        $this->call(BlogsTableSeeder::class);
        $this->call(CacheTableSeeder::class);
        $this->call(CacheLocksTableSeeder::class);
        $this->call(CartsTableSeeder::class);
        $this->call(ErrorLogsTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(JobBatchesTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderItemsTableSeeder::class);
        $this->call(OrderStatusLogsTableSeeder::class);
        $this->call(PasswordResetTokensTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PersonalAccessTokensTableSeeder::class);
        $this->call(PricingConfigsTableSeeder::class);
        $this->call(ProductReviewsTableSeeder::class);
        $this->call(RecentlyViewedProductsTableSeeder::class);
        $this->call(RiderBankDetailsTableSeeder::class);
        $this->call(RiderPayoutsTableSeeder::class);
        $this->call(RiderPayoutRulesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(SessionsTableSeeder::class);
        $this->call(ShippingAddressesTableSeeder::class);
        $this->call(SlidesTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(VendorBankDetailsTableSeeder::class);
        $this->call(VendorOrdersTableSeeder::class);
        $this->call(VendorPayoutsTableSeeder::class);
        $this->call(VendorProductsTableSeeder::class);
        $this->call(VendorProductItemsTableSeeder::class);
        $this->call(VendorProfilesTableSeeder::class);
        $this->call(WeightTiersTableSeeder::class);
        $this->call(WishlistsTableSeeder::class);
    }
}
