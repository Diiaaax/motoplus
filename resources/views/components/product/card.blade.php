@props(['product'])

@php
$hasDiscount = $product->compare_at_price && $product->compare_at_price > $product->price;
$discount = $hasDiscount ? $product->calculateDiscount() : null;
$image = $product->images->first()?->image_url ? asset('storage/' . $product->images->first()->image_url) : null;
$brandName = $product->brand?->name;
@endphp

<div class="group relative bg-white dark:bg-dark-800 rounded-2xl border border-surface-100 dark:border-dark-700 overflow-hidden hover:shadow-xl hover:shadow-surface-900/5 dark:hover:shadow-black/20 hover:-translate-y-1 transition-all duration-300">
    @if($discount)
        <div class="absolute top-4 left-4 rtl:left-auto rtl:right-4 z-10">
            <span class="badge-red">-{{ $discount }}%</span>
        </div>
    @endif

    @if($product->is_featured)
        <div class="absolute top-4 right-4 rtl:right-auto rtl:left-4 z-10">
            <span class="badge-blue">Featured</span>
        </div>
    @endif

    <a href="{{ route('products.show', $product->slug) }}" class="block aspect-[4/3] bg-surface-50 dark:bg-dark-900 overflow-hidden">
        @if($image)
            <img src="{{ $image }}" alt="{{ $product->title }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                loading="lazy" width="400" height="300">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-16 h-16 text-surface-300 dark:text-dark-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
        @endif
    </a>

    <div class="p-5">
        @if($brandName)
            <p class="text-xs font-medium text-moto-600 dark:text-moto-400 uppercase tracking-wider mb-1">{{ $brandName }}</p>
        @endif

        <a href="{{ route('products.show', $product->slug) }}">
            <h3 class="font-semibold text-surface-900 dark:text-white group-hover:text-moto-600 dark:group-hover:text-moto-400 transition-colors line-clamp-2">{{ $product->title }}</h3>
        </a>

        @if($product->vehicle_type)
            <p class="text-xs text-surface-400 dark:text-dark-400 mt-1 capitalize">{{ str_replace('_', ' ', $product->vehicle_type) }}</p>
        @endif

        <div class="flex items-center justify-between mt-4 pt-4 border-t border-surface-100 dark:border-dark-700">
            <div>
                <span class="text-lg font-bold text-surface-900 dark:text-white">{{ number_format($product->price, 0) }} DZD</span>
                @if($hasDiscount)
                    <span class="text-sm text-surface-400 dark:text-dark-400 line-through ml-2 rtl:ml-0 rtl:mr-2">{{ number_format($product->compare_at_price, 0) }}</span>
                @endif
            </div>

            @if($product->inventory > 0)
                <span class="flex items-center gap-1 text-xs text-moto-600 dark:text-moto-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-moto-500" aria-hidden="true"></span>
                    <span class="sr-only">In Stock</span>
                    <span aria-hidden="true">In Stock</span>
                </span>
            @else
                <span class="text-xs text-surface-400 dark:text-dark-400">Pre-order</span>
            @endif
        </div>

        <a href="{{ route('products.show', $product->slug) }}" class="btn-primary w-full text-sm py-2.5 mt-4 lg:mt-0 lg:opacity-0 lg:group-hover:opacity-100 lg:translate-y-2 lg:group-hover:translate-y-0 transition-all duration-300">
            View Details
        </a>
    </div>
</div>
