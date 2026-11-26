@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="pt-24 pb-16 bg-white dark:bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="section-title">Search Results</h1>
            @if(isset($query))
                <p class="text-surface-500 dark:text-dark-300 mt-2">
                    {{ $products->total() }} results for "<strong class="text-surface-900 dark:text-white">{{ $query }}</strong>"
                </p>
            @endif
        </div>

        @if(isset($products) && $products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-surface-900 dark:text-white mb-2">No results found</h3>
                <p class="text-surface-500 dark:text-dark-300 mb-6">Try different keywords or browse our catalog.</p>
                <a href="{{ route('catalog') }}" class="btn-primary">Browse Catalog</a>
            </div>
        @endif
    </div>
</div>
@endsection
