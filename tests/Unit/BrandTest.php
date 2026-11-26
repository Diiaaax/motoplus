<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_brand(): void
    {
        $brand = Brand::create([
            'name' => 'Test Brand',
            'slug' => 'test-brand',
            'is_active' => true,
        ]);

        $this->assertDatabaseHas('brands', ['slug' => 'test-brand']);
    }

    public function test_brand_has_products_relation(): void
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $this->assertTrue($brand->products->contains($product));
    }

    public function test_active_scope_filters_correctly(): void
    {
        Brand::factory()->create(['is_active' => true, 'name' => 'Active Brand', 'slug' => 'active-brand']);
        Brand::factory()->create(['is_active' => false, 'name' => 'Inactive Brand', 'slug' => 'inactive-brand']);

        $activeBrands = Brand::active()->get();

        $this->assertCount(1, $activeBrands);
        $this->assertEquals('Active Brand', $activeBrands->first()->name);
    }

    public function test_slug_is_unique(): void
    {
        Brand::factory()->create(['slug' => 'unique-slug']);

        $this->expectException(\Illuminate\Database\QueryException::class);
        Brand::factory()->create(['slug' => 'unique-slug']);
    }
}
