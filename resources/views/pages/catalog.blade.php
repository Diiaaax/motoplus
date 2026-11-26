@extends('layouts.app')

@section('meta_tags')
<meta property="og:title" content="Catalog - MotoPlus Algeria">
<meta property="og:description" content="Browse our collection of premium electric motorcycles, scooters, and accessories.">
@endsection

@section('canonical', route('catalog'))

@section('title', 'Catalog')

@section('content')
<div class="pt-24 pb-16 bg-white dark:bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="section-title">Catalog</h1>
            <p class="section-subtitle text-left mt-2">Discover our complete collection of electric vehicles and accessories.</p>
        </div>

        @livewire('catalog-filters', [
            'categories' => $categories ?? collect(),
            'brands' => $brands ?? collect(),
            'filters' => $filters ?? [],
        ])

        <div class="mt-8">
            @if(isset($products) && $products->count() > 0)
                <div class="flex items-center justify-between mb-6">
                    <p class="text-sm text-surface-500 dark:text-dark-300">
                        Showing <strong>{{ $products->firstItem() }}-{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong> products
                    </p>
                    <div class="flex items-center gap-2">
                        <label class="text-sm text-surface-500 dark:text-dark-300">Sort:</label>
                        <select onchange="window.location.href=this.value" class="input-field py-2 pr-8 text-sm w-auto">
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => 'desc']) }}" @selected(request('sort') === 'created_at' || !request('sort'))>Newest</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'asc']) }}" @selected(request('sort') === 'price' && request('direction') === 'asc')>Price: Low to High</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'desc']) }}" @selected(request('sort') === 'price' && request('direction') === 'desc')>Price: High to Low</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'title', 'direction' => 'asc']) }}" @selected(request('sort') === 'title')>Name: A-Z</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <x-product.card :product="$product" />
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-16 h-16 mx-auto text-surface-300 dark:text-dark-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-surface-900 dark:text-white mb-2">No products found</h3>
                    <p class="text-surface-500 dark:text-dark-300 mb-6">Try adjusting your filters or search terms.</p>
                    <a href="{{ route('catalog') }}" class="btn-primary">Clear Filters</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
