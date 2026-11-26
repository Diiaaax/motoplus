<?php

namespace Database\Factories;

use App\Models\DeliveryCompany;
use App\Models\DeliveryPrice;
use App\Models\Wilaya;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryPriceFactory extends Factory
{
    protected $model = DeliveryPrice::class;

    public function definition(): array
    {
        return [
            'wilaya_code' => Wilaya::factory(),
            'company_id' => DeliveryCompany::factory(),
            'door' => fake()->numberBetween(300, 2000),
            'stopdesk' => fake()->numberBetween(200, 1500),
            'delivery_time' => '24-48',
        ];
    }
}
