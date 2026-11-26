<?php

namespace Tests\Unit;

use App\Models\Wilaya;
use App\Models\DeliveryCompany;
use App\Services\DeliveryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DeliveryServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_calculates_door_and_stopdesk_prices(): void
    {
        Wilaya::factory()->create(['wilaya_code' => 16]);
        $company = DeliveryCompany::factory()->create();
        DB::table('delivery_prices')
            ->where('wilaya_code', 16)
            ->where('company_id', $company->id)
            ->update([
                'door' => 500,
                'stopdesk' => 300,
                'delivery_time' => '24-48',
            ]);

        $service = new DeliveryService();
        $this->assertEquals(500, $service->calculatePrice(16, 'Door'));
        $this->assertEquals(300, $service->calculatePrice(16, 'StopDesk'));
        $this->assertEquals('24-48', $service->getDeliveryTime(16));
    }

    public function test_returns_zero_for_unknown_wilaya(): void
    {
        $service = new DeliveryService();
        $price = $service->calculatePrice(999);
        $this->assertEquals(0, $price);
    }

    public function test_gets_active_company(): void
    {
        DeliveryCompany::factory()->create(['name' => 'Active Carrier', 'is_active' => true]);
        DeliveryCompany::factory()->create(['name' => 'Inactive Carrier', 'is_active' => false]);

        $service = new DeliveryService();
        $active = $service->getActiveCompany();

        $this->assertNotNull($active);
        $this->assertEquals('Active Carrier', $active->name);
    }

    public function test_returns_all_wilayas(): void
    {
        Wilaya::factory()->create(['wilaya_code' => 1, 'wilaya_name_fr' => 'Adrar']);
        Wilaya::factory()->create(['wilaya_code' => 2, 'wilaya_name_fr' => 'Chlef']);

        $service = new DeliveryService();
        $wilayas = $service->getAllWilayas();

        $this->assertCount(2, $wilayas);
    }
}
