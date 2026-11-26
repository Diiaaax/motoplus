<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class CatalogService
{
    public function searchProducts(array $filters, int $perPage = 12): LengthAwarePaginator
    {
        $query = Product::with(['categories', 'brand', 'images'])
            ->where('status', 'active');

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['category'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('slug', $filters['category']);
            });
        }

        if (!empty($filters['brand'])) {
            $query->whereHas('brand', function ($q) use ($filters) {
                $q->where('slug', $filters['brand']);
            });
        }

        if (!empty($filters['vehicle_type'])) {
            $query->where('vehicle_type', $filters['vehicle_type']);
        }

        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        if (!empty($filters['tag'])) {
            $query->whereJsonContains('tags', $filters['tag']);
        }

        $sortField = $filters['sort'] ?? 'created_at';
        $sortDir = $filters['direction'] ?? 'desc';
        $allowedSorts = ['price', 'created_at', 'title', 'model_year'];

        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortDir === 'asc' ? 'asc' : 'desc');
        } else {
            $query->latest();
        }

        return $query->paginate($perPage);
    }

    public function getFilteredProducts(array $filters)
    {
        $query = Product::with(['categories', 'brand', 'images'])
            ->where('status', 'active');

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['category'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('slug', $filters['category']);
            });
        }

        if (!empty($filters['brand'])) {
            $query->whereHas('brand', function ($q) use ($filters) {
                $q->where('slug', $filters['brand']);
            });
        }

        if (!empty($filters['vehicle_type'])) {
            $query->where('vehicle_type', $filters['vehicle_type']);
        }

        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        if (!empty($filters['tag'])) {
            $query->whereJsonContains('tags', $filters['tag']);
        }

        $sortField = $filters['sort'] ?? 'created_at';
        $sortDir = $filters['direction'] ?? 'desc';
        $allowedSorts = ['price', 'created_at', 'title', 'model_year'];

        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortDir === 'asc' ? 'asc' : 'desc');
        } else {
            $query->latest();
        }

        return $query;
    }

    public function getRelatedProducts(Product $product, int $limit = 12)
    {
        $categoryIds = $product->categories->pluck('id');

        return Product::with(['categories', 'brand', 'images'])
            ->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            })
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->limit($limit)
            ->get();
    }

    public function getFeaturedProducts()
    {
        return Cache::remember('products.featured', 3600, function () {
            return Product::with(['categories', 'brand', 'images'])
                ->where('is_featured', true)
                ->where('status', 'active')
                ->latest()
                ->get();
        });
    }

    public function getNewestProducts(int $limit = 8)
    {
        return Cache::remember('products.newest', 3600, function () use ($limit) {
            return Product::with(['categories', 'brand', 'images'])
                ->where('status', 'active')
                ->latest()
                ->limit($limit)
                ->get();
        });
    }

    public function getDiscountedProducts()
    {
        return Cache::remember('products.discounted', 3600, function () {
            return Product::with(['categories', 'brand', 'images'])
                ->whereNotNull('compare_at_price')
                ->whereColumn('compare_at_price', '>', 'price')
                ->where('status', 'active')
                ->latest()
                ->get();
        });
    }

    public function getProductsByBrand(string $brandSlug)
    {
        return Product::with(['categories', 'brand', 'images'])
            ->whereHas('brand', function ($q) use ($brandSlug) {
                $q->where('slug', $brandSlug);
            })
            ->where('status', 'active')
            ->latest()
            ->paginate(12);
    }

    public static function clearCache(): void
    {
        Cache::forget('products.featured');
        Cache::forget('products.newest');
        Cache::forget('products.discounted');
    }
}
