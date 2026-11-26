<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_page_loads(): void
    {
        $response = $this->get('/search?q=moto');

        $response->assertStatus(200);
    }

    public function test_search_returns_live_results(): void
    {
        $brand = Brand::factory()->create(['name' => 'TestBrand', 'slug' => 'testbrand']);

        $product = Product::factory()->create([
            'title' => 'Moto Electrique',
            'slug' => 'moto-electrique',
            'brand_id' => $brand->id,
        ]);

        $response = $this->get('/search/live?q=Moto');

        $response->assertStatus(200);
    }
}
