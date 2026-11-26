<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Services\CatalogService;

class BrandController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService
    ) {}

    public function index()
    {
        $brands = Brand::active()->withCount('products')->get();
        return view('pages.brands', compact('brands'));
    }

    public function show($slug)
    {
        $brand = Brand::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $products = $this->catalogService->getProductsByBrand($brand->slug);

        return view('pages.brand-detail', compact('brand', 'products'));
    }
}
