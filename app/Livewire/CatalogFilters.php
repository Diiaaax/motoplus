<?php

namespace App\Livewire;

use Livewire\Component;

class CatalogFilters extends Component
{
    public $search = '';
    public $category = '';
    public $brand = '';
    public $vehicleType = '';
    public $minPrice = '';
    public $maxPrice = '';

    public $categories = [];
    public $brands = [];

    public function mount($filters = [])
    {
        $this->categories = \App\Models\Category::all();
        $this->brands = \App\Models\Brand::active()->get();

        $this->search = $filters['search'] ?? request('search', '');
        $this->category = $filters['category'] ?? request('category', '');
        $this->brand = $filters['brand'] ?? request('brand', '');
        $this->vehicleType = $filters['vehicle_type'] ?? request('vehicle_type', '');
        $this->minPrice = $filters['min_price'] ?? request('min_price', '');
        $this->maxPrice = $filters['max_price'] ?? request('max_price', '');
    }

    public function applyFilters()
    {
        $params = array_filter([
            'search' => $this->search,
            'category' => $this->category,
            'brand' => $this->brand,
            'vehicle_type' => $this->vehicleType,
            'min_price' => $this->minPrice,
            'max_price' => $this->maxPrice,
        ]);

        return redirect()->route('catalog', $params);
    }

    public function resetFilters()
    {
        $this->reset(['search', 'category', 'brand', 'vehicleType', 'minPrice', 'maxPrice']);
        return redirect()->route('catalog');
    }

    public function render()
    {
        return view('livewire.catalog-filters');
    }
}
