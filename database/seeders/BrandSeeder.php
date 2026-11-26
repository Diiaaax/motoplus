<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Zero Motorcycles', 'description' => 'American manufacturer of electric motorcycles since 2006. Known for high-performance street and dual-sport bikes.', 'country' => 'USA', 'sort_order' => 1],
            ['name' => 'LiveWire', 'description' => 'Premium electric motorcycle brand spun off from Harley-Davidson. Combining iconic style with electric performance.', 'country' => 'USA', 'sort_order' => 2],
            ['name' => 'Energica', 'description' => 'Italian manufacturer of high-performance electric motorcycles. Racing heritage with street-legal superbikes.', 'country' => 'Italy', 'sort_order' => 3],
            ['name' => 'Super Soco', 'description' => 'Chinese brand specializing in stylish urban electric scooters and motorcycles. Very popular in Europe and Asia.', 'country' => 'China', 'sort_order' => 4],
            ['name' => 'Niu', 'description' => 'Leading global brand in smart urban electric scooters. Known for innovative design and connected features.', 'country' => 'China', 'sort_order' => 5],
            ['name' => 'VMoto', 'description' => 'Brazilian-Chinese manufacturer of electric scooters and motorcycles. Strong presence in emerging markets.', 'country' => 'Brazil', 'sort_order' => 6],
            ['name' => 'Silence', 'description' => 'Spanish manufacturer of urban electric scooters with innovative swappable battery technology.', 'country' => 'Spain', 'sort_order' => 7],
            ['name' => 'Horwin', 'description' => 'Chinese manufacturer of electric motorcycles and scooters. Known for accessible pricing and solid quality.', 'country' => 'China', 'sort_order' => 8],
            ['name' => 'Rivian', 'description' => 'American electric vehicle manufacturer expanding into electric adventure motorcycles.', 'country' => 'USA', 'sort_order' => 9],
            ['name' => 'Tao Motors', 'description' => 'Affordable electric scooters and motorcycles for urban commuting. Strong distribution in North Africa.', 'country' => 'China', 'sort_order' => 10],
            ['name' => 'MotoPlus', 'description' => 'Notre marque maison. MotoPlus propose des motos et scooters électriques conçus pour le marché algérien.', 'country' => 'Algeria', 'sort_order' => 11],
            ['name' => 'BMW Motorrad', 'description' => 'German premium motorcycle manufacturer with growing electric lineup including the CE 04 scooter.', 'country' => 'Germany', 'sort_order' => 12],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'description' => $brand['description'],
                'country' => $brand['country'],
                'is_active' => true,
                'sort_order' => $brand['sort_order'],
            ]);
        }
    }
}
