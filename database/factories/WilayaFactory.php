<?php

namespace Database\Factories;

use App\Models\Wilaya;
use Illuminate\Database\Eloquent\Factories\Factory;

class WilayaFactory extends Factory
{
    protected $model = Wilaya::class;

    public function definition(): array
    {
        return [
            'wilaya_code' => fake()->unique()->numberBetween(1, 58),
            'wilaya_name_ar' => fake()->word(),
            'wilaya_name_fr' => fake()->city(),
        ];
    }
}
