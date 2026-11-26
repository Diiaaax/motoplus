<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Product;
use App\Livewire\CatalogFilters;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CatalogFiltersTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_renders(): void
    {
        Livewire::test(CatalogFilters::class)
            ->assertStatus(200);
    }

    public function test_resets_filters(): void
    {
        Livewire::test(CatalogFilters::class)
            ->set('search', 'test')
            ->call('resetFilters')
            ->assertSet('search', '')
            ->assertSet('vehicleType', '');
    }
}
