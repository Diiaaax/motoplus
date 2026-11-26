@extends('layouts.app')

@section('title', $product->title)

@section('meta_tags')
<meta property="og:title" content="{{ $product->title }} - MotoPlus Algeria">
<meta property="og:description" content="{{ strip_tags($product->description ?? '') }}">
<meta property="og:image" content="{{ $product->images->first()?->image_url ? asset('storage/' . $product->images->first()->image_url) : asset('images/og-default.jpg') }}">
<meta property="og:type" content="product">
<meta name="twitter:card" content="summary_large_image">
@endsection

@section('canonical', route('products.show', $product->slug))

@section('schema')
<script type="application/ld+json">{!! json_encode($productSchema ?? []) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbs ?? []) !!}</script>
@endsection

@section('content')
<div class="pt-24 pb-16 bg-white dark:bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-2 text-sm text-surface-500 dark:text-dark-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-moto-600 dark:hover:text-moto-400 transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('catalog') }}" class="hover:text-moto-600 dark:hover:text-moto-400 transition-colors">Catalog</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-surface-900 dark:text-white font-medium">{{ $product->title }}</span>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12">
            {{-- Gallery --}}
            <div x-data="{
    mainImage: null,
    images: [],
    init() {
        this.images = this.$el.dataset.images ? JSON.parse(this.$el.dataset.images) : [];
        this.mainImage = this.images[0] || null;
    },
    setImage(image) { this.mainImage = image; },
    zoom(e) {
        const img = e.currentTarget;
        const rect = img.getBoundingClientRect();
        img.style.transformOrigin = ((e.clientX - rect.left) / rect.width * 100) + '% ' + ((e.clientY - rect.top) / rect.height * 100) + '%';
        img.style.transform = 'scale(2)';
    },
    resetZoom(e) { e.currentTarget.style.transform = 'scale(1)'; },
}" data-images="{{ json_encode($product->images->pluck('image_url')->toArray()) }}" class="space-y-4">
                <div class="aspect-square rounded-2xl bg-surface-50 dark:bg-dark-900 overflow-hidden">
                    <template x-if="mainImage">
                        <img
                            :src="'{{ asset('storage') }}/' + mainImage"
                            alt="{{ $product->title }}"
                            class="w-full h-full object-cover cursor-crosshair transition-transform duration-200"
                            @mousemove="zoom($event)"
                            @mouseleave="resetZoom($event)"
                        >
                    </template>
                    <template x-if="!mainImage">
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-24 h-24 text-surface-300 dark:text-dark-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </template>
                </div>
                <div class="flex gap-3 overflow-x-auto scrollbar-hide pb-2" x-show="images.length > 1">
                    <template x-for="(image, index) in images" :key="index">
                        <button
                            @click="setImage(image)"
                            class="flex-shrink-0 w-20 h-20 rounded-xl border-2 overflow-hidden transition-all duration-200"
                            :class="mainImage === image ? 'border-moto-500 ring-2 ring-moto-500/20' : 'border-surface-200 dark:border-dark-700 hover:border-surface-300 dark:hover:border-dark-600'"
                        >
                            <img :src="'{{ asset('storage') }}/' + image" alt="" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>

            {{-- Product Info --}}
            <div class="space-y-8">
                <div>
                    @if($product->brand)
                        <a href="{{ route('brands.show', $product->brand->slug) }}" class="inline-flex items-center gap-2 text-sm font-medium text-moto-600 dark:text-moto-400 hover:text-moto-700 mb-2">
                            {{ $product->brand->name }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    @endif

                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-display font-bold text-surface-900 dark:text-white tracking-tight">
                        {{ $product->title }}
                    </h1>

                    @if($product->condition)
                        <span class="inline-flex items-center gap-1 mt-2 text-sm text-surface-500 dark:text-dark-300">
                            <span class="w-1.5 h-1.5 rounded-full bg-moto-500"></span>
                            {{ ucfirst($product->condition) }} · {{ $product->model_year ?? 'Current Model' }}
                        </span>
                    @endif
                </div>

                {{-- Pricing --}}
                <div class="flex items-baseline gap-4">
                    <span class="text-4xl font-bold text-surface-900 dark:text-white">{{ number_format($product->price, 0) }} DZD</span>
                    @if(isset($discount))
                        <span class="text-xl text-surface-400 dark:text-dark-400 line-through">{{ number_format($product->compare_at_price, 0) }} DZD</span>
                        <span class="badge-red text-sm">-{{ $discount }}%</span>
                    @endif
                </div>

                {{-- Highlights --}}
                @if($product->highlights)
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->highlights as $highlight)
                            <span class="badge-green text-xs">{{ $highlight }}</span>
                        @endforeach
                    </div>
                @endif

                {{-- Quick Specs --}}
                @if($product->specifications->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @php
                            $keySpecs = $product->specifications->whereIn('group', ['Motor', 'Battery', 'Performance'])->take(6);
                        @endphp
                        @foreach($keySpecs as $spec)
                            <div class="bg-surface-50 dark:bg-dark-800 rounded-xl p-4 text-center">
                                <p class="text-xs font-medium text-surface-500 dark:text-dark-400 uppercase tracking-wider">{{ $spec->label }}</p>
                                <p class="text-sm font-bold text-surface-900 dark:text-white mt-1">{{ $spec->value }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="btn-primary flex-1 text-base py-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        Add to Cart
                    </button>
                    <form action="{{ route('wishlist.add', $product) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-outline px-6 py-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </form>
                    <form action="{{ route('compare.add', $product) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-ghost px-6 py-4 border-2 border-dashed border-surface-200 dark:border-dark-700 rounded-xl hover:border-moto-500 dark:hover:border-moto-400 hover:text-moto-600 dark:hover:text-moto-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- Delivery Info --}}
                <div class="glass-card p-6 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-moto-100 dark:bg-moto-900/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-moto-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-surface-900 dark:text-white">Delivery across Algeria</p>
                            <p class="text-sm text-surface-500 dark:text-dark-300">Serving all 58 wilayas with real-time tracking</p>
                        </div>
                    </div>

                    @if($product->warranty_info)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-surface-900 dark:text-white">Warranty</p>
                            <p class="text-sm text-surface-500 dark:text-dark-300">{{ $product->warranty_info }}</p>
                        </div>
                    </div>
                    @endif

                    @if($product->manual_pdf)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <a href="{{ asset('storage/' . $product->manual_pdf) }}" target="_blank" class="font-medium text-moto-600 hover:text-moto-700 dark:text-moto-400 dark:hover:text-moto-500">
                                Download Manual
                            </a>
                            <p class="text-sm text-surface-500 dark:text-dark-300">PDF format</p>
                        </div>
                    </div>
                    @endif

                    @if($product->video_url)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <a href="{{ $product->video_url }}" target="_blank" class="font-medium text-moto-600 hover:text-moto-700 dark:text-moto-400 dark:hover:text-moto-500">Watch Video Review</a>
                            <p class="text-sm text-surface-500 dark:text-dark-300">Product showcase</p>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Financing Estimator --}}
                @if(isset($financingEstimates) && count($financingEstimates) > 0)
                <div class="glass-card p-6">
                    <h3 class="font-semibold text-surface-900 dark:text-white mb-4">Financing Available</h3>
                    <div class="space-y-3">
                        @foreach($financingEstimates as $estimate)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-surface-50 dark:bg-dark-800">
                            <div>
                                <p class="text-sm font-medium text-surface-900 dark:text-white">{{ $estimate['months'] }} months</p>
                                <p class="text-xs text-surface-500 dark:text-dark-300">{{ $estimate['down_payment_percent'] }}% down payment</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-surface-900 dark:text-white">{{ number_format($estimate['monthly_payment'], 0) }} DZD/mo</p>
                                <p class="text-xs text-surface-500 dark:text-dark-300">{{ $estimate['annual_rate'] }}% APR</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('financing.index') }}" class="text-sm font-medium text-moto-600 hover:text-moto-700 dark:text-moto-400 dark:hover:text-moto-500 mt-3 inline-block">View all financing options →</a>
                </div>
                @endif
            </div>
        </div>

        {{-- Full Specifications --}}
        @if($product->specifications->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-display font-bold text-surface-900 dark:text-white mb-8">Technical Specifications</h2>
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($product->specifications->groupBy('group') as $group => $specs)
                <div class="glass-card p-6">
                    <h3 class="font-semibold text-surface-900 dark:text-white mb-4 text-lg">{{ $group }}</h3>
                    <div class="space-y-3">
                        @foreach($specs as $spec)
                        <div class="flex items-center justify-between py-2 border-b border-surface-100 dark:border-dark-700 last:border-0">
                            <span class="text-sm text-surface-500 dark:text-dark-300">{{ $spec->label }}</span>
                            <span class="text-sm font-medium text-surface-900 dark:text-white">{{ $spec->value }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Description --}}
        @if($product->description)
        <div class="mt-16">
            <h2 class="text-2xl font-display font-bold text-surface-900 dark:text-white mb-8">Description</h2>
            <div class="prose prose-surface dark:prose-invert max-w-none">
                {!! $product->description !!}
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Related Products --}}
@if(isset($relatedProducts) && $relatedProducts->count() > 0)
<section class="py-16 bg-surface-50 dark:bg-dark-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-display font-bold text-surface-900 dark:text-white mb-8">You May Also Like</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
                <x-product.card :product="$related" />
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
