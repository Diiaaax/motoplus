<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Services\CatalogService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService
    ) {}

    public function index(Request $request)
    {
        $filters = $request->only([
            'search', 'category', 'brand', 'vehicle_type',
            'min_price', 'max_price', 'tag', 'sort', 'direction'
        ]);

        $products = $this->catalogService->searchProducts($filters);
        $categories = Category::all();
        $brands = Brand::active()->get();

        return view('pages.catalog', compact('products', 'categories', 'brands', 'filters'));
    }
}
