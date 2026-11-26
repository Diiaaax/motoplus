<?php

namespace Tests\Unit;

use App\Services\FinancingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FinancingServiceTest extends TestCase
{
    public function test_calculates_monthly_payment(): void
    {
        $service = new FinancingService();
        $result = $service->calculateMonthlyPayment(300000, 0, 0, 12);

        $this->assertEquals(25000, $result['monthly_payment']);
    }

    public function test_calculates_with_interest(): void
    {
        $service = new FinancingService();
        $result = $service->calculateMonthlyPayment(300000, 0, 10, 12);

        $this->assertGreaterThan(25000, $result['monthly_payment']);
        $this->assertGreaterThan(0, $result['total_interest']);
    }

    public function test_with_down_payment(): void
    {
        $service = new FinancingService();
        $result = $service->calculateMonthlyPayment(300000, 20, 10, 12);

        $this->assertEquals(60000, $result['down_payment']);
        $this->assertEquals(240000, $result['principal']);
    }

    public function test_handles_long_term(): void
    {
        $service = new FinancingService();
        $result = $service->calculateMonthlyPayment(600000, 0, 8, 48);

        $this->assertLessThan(600000 / 48 * 2, $result['monthly_payment']);
        $this->assertEquals(48, $result['months']);
    }

    public function test_returns_expected_keys(): void
    {
        $service = new FinancingService();
        $result = $service->calculateMonthlyPayment(300000, 10, 8, 24);

        $this->assertArrayHasKey('monthly_payment', $result);
        $this->assertArrayHasKey('down_payment', $result);
        $this->assertArrayHasKey('principal', $result);
        $this->assertArrayHasKey('total_interest', $result);
        $this->assertArrayHasKey('total_paid', $result);
    }
}
