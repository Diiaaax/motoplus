<?php

namespace Database\Factories;

use App\Models\DeliveryCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryCompanyFactory extends Factory
{
    protected $model = DeliveryCompany::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'is_active' => true,
        ];
    }
}
