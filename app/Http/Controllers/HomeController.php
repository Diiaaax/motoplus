<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Services\CatalogService;

class HomeController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService
    ) {}

    public function index()
    {
        $featuredProducts = $this->catalogService->getFeaturedProducts();
        $newestProducts = $this->catalogService->getNewestProducts();
        $discountedProducts = $this->catalogService->getDiscountedProducts();
        $banners = Banner::where('is_active', true)->orderBy('sort_order')->get();
        $brands = Brand::active()->get();

        return view('pages.home', compact(
            'featuredProducts',
            'newestProducts',
            'discountedProducts',
            'banners',
            'brands'
        ));
    }
}
