<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $staticPages = [
            ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => route('catalog'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => route('brands.index'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => route('compare'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => route('contact'), 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => route('about'), 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => route('services'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => route('terms'), 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['loc' => route('faq'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => route('search'), 'priority' => '0.4', 'changefreq' => 'monthly'],
        ];

        $products = Product::active()->get(['slug', 'updated_at']);
        $brands = Brand::active()->get(['slug', 'updated_at']);

        return Response::view('sitemap', [
            'staticPages' => $staticPages,
            'products' => $products,
            'brands' => $brands,
        ])->header('Content-Type', 'application/xml');
    }
}
