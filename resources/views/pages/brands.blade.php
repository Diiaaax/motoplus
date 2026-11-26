@extends('layouts.app')

@section('title', 'Brands')

@section('meta_tags')
<meta property="og:title" content="Brands - MotoPlus Algeria">
<meta property="og:description" content="Explore premium electric motorcycle brands available at MotoPlus Algeria.">
@endsection

@section('canonical', route('brands.index'))

@section('content')
<div class="pt-24 pb-16 bg-white dark:bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="section-title">Our Brands</h1>
            <p class="section-subtitle">We partner with the world's leading electric vehicle manufacturers to bring you the best in quality, performance, and design.</p>
        </div>

        @if(isset($brands) && $brands->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($brands as $brand)
                <a href="{{ route('brands.show', $brand->slug) }}" class="group glass-card p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-start gap-6">
                        <div class="w-20 h-20 rounded-2xl bg-surface-100 dark:bg-dark-800 flex items-center justify-center flex-shrink-0 group-hover:bg-moto-50 dark:group-hover:bg-moto-900/20 transition-colors">
                            @if($brand->logo_url)
                                <img src="{{ asset('storage/' . $brand->logo_url) }}" alt="{{ $brand->name }}" class="w-14 h-14 object-contain">
                            @else
                                <span class="text-2xl font-bold text-surface-400 dark:text-dark-400 group-hover:text-moto-600 dark:group-hover:text-moto-400 transition-colors">{{ substr($brand->name, 0, 2) }}</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-xl font-bold text-surface-900 dark:text-white group-hover:text-moto-600 dark:group-hover:text-moto-400 transition-colors">{{ $brand->name }}</h3>
                            @if($brand->country)
                                <p class="text-sm text-surface-500 dark:text-dark-300 mt-1">{{ $brand->country }}</p>
                            @endif
                            @if($brand->products_count)
                                <p class="text-sm text-moto-600 dark:text-moto-400 mt-3 font-medium">{{ $brand->products_count }} models available</p>
                            @endif
                            @if($brand->description)
                                <p class="text-sm text-surface-500 dark:text-dark-300 mt-2 line-clamp-2">{{ $brand->description }}</p>
                            @endif
                        </div>
                        <svg class="w-5 h-5 text-surface-300 dark:text-dark-500 group-hover:text-moto-500 dark:group-hover:text-moto-400 transition-colors flex-shrink-0 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-surface-500 dark:text-dark-300">No brands available yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection
