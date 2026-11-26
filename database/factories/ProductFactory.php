<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $title = fake()->unique()->words(3, true);
        return [
            'brand_id' => Brand::factory(),
            'sku' => strtoupper(fake()->bothify('MTP-####')),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(),
            'vehicle_type' => fake()->randomElement(['motorcycle', 'scooter', 'bicycle', 'parts']),
            'condition' => 'new',
            'model_year' => fake()->year(),
            'price' => fake()->numberBetween(100000, 5000000),
            'status' => true,
            'inventory' => fake()->numberBetween(0, 50),
            'is_featured' => fake()->boolean(),
        ];
    }
}
