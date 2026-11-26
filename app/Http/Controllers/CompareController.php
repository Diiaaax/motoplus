<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\DTOs\ComparisonDTO;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    private function getSessionId(): string
    {
        return session()->getId();
    }

    public function index()
    {
        $comparisonIds = \App\Models\Comparison::where('session_id', $this->getSessionId())
            ->pluck('product_id');

        $products = Product::with(['specifications', 'brand', 'images'])
            ->whereIn('id', $comparisonIds)
            ->get();

        $comparisonDTO = ComparisonDTO::fromProducts($products->toArray());

        return view('pages.compare', compact('products', 'comparisonDTO'));
    }

    public function add(Product $product)
    {
        $count = \App\Models\Comparison::where('session_id', $this->getSessionId())->count();

        if ($count >= 4) {
            return back()->with('error', 'You can compare up to 4 products at a time.');
        }

        \App\Models\Comparison::firstOrCreate([
            'session_id' => $this->getSessionId(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Product added to comparison.');
    }

    public function remove(Product $product)
    {
        \App\Models\Comparison::where('session_id', $this->getSessionId())
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', 'Product removed from comparison.');
    }

    public function getCompareData()
    {
        $productIds = \App\Models\Comparison::where('session_id', $this->getSessionId())
            ->pluck('product_id');

        $products = Product::with(['specifications', 'brand', 'images'])
            ->whereIn('id', $productIds)
            ->get();

        return response()->json([
            'count' => $products->count(),
            'products' => $products->map(fn($p) => [
                'id' => $p->id,
                'title' => $p->title,
                'slug' => $p->slug,
                'price' => $p->price,
                'image' => $p->images->first()?->image_url,
            ]),
        ]);
    }
}
