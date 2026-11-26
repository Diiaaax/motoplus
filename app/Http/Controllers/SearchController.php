<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Services\CatalogService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService
    ) {}

    public function index(Request $request)
    {
        $query = $request->get('q');
        $products = Product::with(['images', 'brand'])
            ->where('status', 'active')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(12);

        return view('pages.search', compact('products', 'query'));
    }

    public function live(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $products = Product::with(['images', 'brand'])
            ->where('status', 'active')
            ->where('title', 'like', "%{$query}%")
            ->limit(6)
            ->get()
            ->map(fn($p) => [
                'title' => $p->title,
                'slug' => $p->slug,
                'price' => number_format($p->price, 2) . ' DZD',
                'image' => $p->images->first()?->image_url 
                    ? asset('storage/' . $p->images->first()->image_url) 
                    : null,
                'brand' => $p->brand?->name,
            ]);

        return response()->json($products);
    }
}
