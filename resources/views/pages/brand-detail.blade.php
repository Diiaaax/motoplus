@extends('layouts.app')

@section('title', $brand->name)

@section('meta_tags')
<meta property="og:title" content="{{ $brand->name }} - MotoPlus Algeria">
<meta property="og:description" content="{{ strip_tags($brand->description ?? '') }}">
@if($brand->logo_url)
    <meta property="og:image" content="{{ asset('storage/' . $brand->logo_url) }}">
@endif
@endsection

@section('canonical', route('brands.show', $brand->slug))

@section('content')
<div class="pt-24 pb-16 bg-white dark:bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm text-surface-500 dark:text-dark-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-moto-600 dark:hover:text-moto-400 transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('brands.index') }}" class="hover:text-moto-600 dark:hover:text-moto-400 transition-colors">Brands</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-surface-900 dark:text-white font-medium">{{ $brand->name }}</span>
        </nav>

        <div class="glass-card p-8 md:p-12 mb-12">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-32 h-32 rounded-2xl bg-surface-100 dark:bg-dark-800 flex items-center justify-center flex-shrink-0">
                    @if($brand->logo_url)
                        <img src="{{ asset('storage/' . $brand->logo_url) }}" alt="{{ $brand->name }}" class="w-24 h-24 object-contain">
                    @else
                        <span class="text-4xl font-bold text-surface-400 dark:text-dark-400">{{ substr($brand->name, 0, 2) }}</span>
                    @endif
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-4xl font-display font-bold text-surface-900 dark:text-white">{{ $brand->name }}</h1>
                    @if($brand->country)
                        <p class="text-surface-500 dark:text-dark-300 mt-1">{{ $brand->country }}</p>
                    @endif
                    @if($brand->website_url)
                        <a href="{{ $brand->website_url }}" target="_blank" rel="noopener noreferrer" class="text-sm text-moto-600 hover:text-moto-700 dark:text-moto-400 dark:hover:text-moto-500 mt-2 inline-block">
                            Visit Website →
                        </a>
                    @endif
                    @if($brand->description)
                        <p class="text-surface-500 dark:text-dark-300 mt-4 max-w-2xl">{{ $brand->description }}</p>
                    @endif
                </div>
            </div>
        </div>

        @if(isset($products) && $products->count() > 0)
            <h2 class="text-2xl font-display font-bold text-surface-900 dark:text-white mb-8">{{ $brand->name }} Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <x-product.card :product="$product" />
                @endforeach
            </div>
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-surface-500 dark:text-dark-300">No products available from this brand yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection
