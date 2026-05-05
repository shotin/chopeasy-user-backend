<?php

namespace Tests\Unit;

use App\Models\AgentEarning;
use App\Models\Order;
use App\Services\AgentCommissionService;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AgentCommissionServiceTest extends TestCase
{
    protected object $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new class extends AgentCommissionService
        {
            public function customerBase(Order $order): float
            {
                return $this->customerCompanyRevenueBase($order);
            }

            public function vendorBase(Order $order, ?float $vendorTakeAmount = null, ?float $grossAmount = null): float
            {
                return $this->vendorCompanyProfitBase($order, $vendorTakeAmount, $grossAmount);
            }

            public function riderBase(Order $order, ?float $riderPayoutAmount = null): float
            {
                return $this->riderCompanyProfitBase($order, $riderPayoutAmount);
            }
        };
    }

    #[Test]
    public function it_uses_platform_revenue_for_customer_commission_base(): void
    {
        $order = new Order([
            'platform_revenue' => 15000,
        ]);

        $this->assertEquals(15000.0, $this->service->customerBase($order));
    }

    #[Test]
    public function it_uses_vendor_take_amount_for_vendor_commission_base(): void
    {
        $order = new Order([
            'pricing_breakdown' => [
                'vendor_take_percent' => 10,
                'payout_breakdown' => [
                    'vendor_take_percent' => 10,
                ],
            ],
        ]);

        $this->assertEquals(2500.0, $this->service->vendorBase($order, 2500, 25000));
    }

    #[Test]
    public function it_uses_delivery_margin_for_rider_commission_base(): void
    {
        $order = new Order([
            'delivery_fee_total' => 5000,
            'rider_payout' => 3500,
        ]);

        $this->assertEquals(1500.0, $this->service->riderBase($order, 3500));
    }

    #[Test]
    public function it_reconstructs_the_recorded_commission_base_for_display(): void
    {
        $earning = new AgentEarning([
            'earning_type' => 'customer_order',
            'commission_percent' => 10,
            'amount' => 1500,
            'order_amount' => 99999,
        ]);

        $details = $this->service->describeEarning($earning);

        $this->assertEquals(15000.0, $details['commission_base_amount']);
        $this->assertSame('Company revenue', $details['commission_base_label']);
    }
}
