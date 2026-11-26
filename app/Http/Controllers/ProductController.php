<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CatalogService;
use App\Services\DeliveryService;
use App\Services\FinancingService;
use App\Services\SEOService;

class ProductController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService,
        private readonly DeliveryService $deliveryService,
        private readonly FinancingService $financingService,
        private readonly SEOService $seoService,
    ) {}

    public function show($slug)
    {
        $product = Product::with([
            'brand', 'categories', 'images', 'specifications',
            'variants', 'reviews' => fn($q) => $q->where('is_approved', true),
            'questions' => fn($q) => $q->where('is_visible', true),
        ])->where('slug', $slug)->firstOrFail();

        $relatedProducts = $this->catalogService->getRelatedProducts($product);
        $wilayas = $this->deliveryService->getAllWilayas();
        $discount = $product->calculateDiscount();
        $financingEstimates = $this->financingService->estimate($product->price);
        $productSchema = $this->seoService->getProductSchema($product);
        $breadcrumbs = $this->seoService->getBreadcrumbs([
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Catalog', 'url' => route('catalog')],
            ['name' => $product->title],
        ]);

        return view('pages.product-details', compact(
            'product', 'relatedProducts', 'wilayas', 'discount',
            'financingEstimates', 'productSchema', 'breadcrumbs'
        ));
    }
}
