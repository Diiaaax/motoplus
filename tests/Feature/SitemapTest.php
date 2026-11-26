<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    use RefreshDatabase;

    public function test_sitemap_xml_returns_200(): void
    {
        Product::factory()->create(['status' => true]);
        Brand::factory()->create(['is_active' => true]);

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
    }

    public function test_sitemap_contains_static_pages(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertSee('<loc>' . route('home') . '</loc>', false);
        $response->assertSee('<loc>' . route('catalog') . '</loc>', false);
    }

    public function test_sitemap_contains_dynamic_entries(): void
    {
        $product = Product::factory()->create(['status' => true, 'slug' => 'test-moto']);
        $brand = Brand::factory()->create(['is_active' => true, 'slug' => 'test-brand']);

        $response = $this->get('/sitemap.xml');

        $response->assertSee('<loc>' . route('products.show', 'test-moto') . '</loc>', false);
        $response->assertSee('<loc>' . route('brands.show', 'test-brand') . '</loc>', false);
    }
}
