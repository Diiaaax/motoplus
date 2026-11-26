@extends('layouts.app')

@section('meta_tags')
<meta property="og:title" content="MotoPlus - Premium Electric Motorcycles Algeria">
<meta property="og:description" content="Discover simple deals and fast delivery across all 58 wilayas of Algeria.">
<meta property="og:image" content="{{ asset('images/og-home.jpg') }}">
<meta name="twitter:card" content="summary_large_image">
@endsection

@section('canonical', config('app.url'))

@section('schema')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => config('app.name'),
    'url' => config('app.url'),
    'logo' => asset('images/logo.png'),
]) !!}</script>
@endsection

@section('content')
<x-home.hero />

{{-- CTA Section --}}
<section class="space-top bg-white dark:bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="title-area">
            <span class="sub-title">{{ __('Simple & Fast Shopping') }}</span>
            <h2 class="sec-title">{{ __('Browse our catalog and find what you need. Fast delivery across all 58 wilayas of Algeria.') }}</h2>
        </div>
        <a href="{{ route('catalog') }}" class="btn-kars inline-flex items-center gap-2">
            {{ __('Browse Catalog') }} <i class="fas fa-arrow-up-right"></i>
        </a>
    </div>
</section>

{{-- Featured Products --}}
@if(isset($featuredProducts) && $featuredProducts->count() > 0)
<section class="space-top space-extra-bottom bg-surface-50 dark:bg-dark-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="title-area">
            <span class="sub-title">{{ __('Featured Products') }}</span>
            <h2 class="sec-title">{{ __('Special Offers') }} <span class="text-[var(--color-theme,#F02801)]">{{ __('Limited Time') }}</span></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts as $product)
                <x-product.card :product="$product" />
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Feature Cards --}}
<section class="space-top space-bottom bg-white dark:bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="title-area">
            <span class="sub-title">{{ __('Why Choose Us') }}</span>
            <h2 class="sec-title">{{ __('Simple & Fast Shopping') }}</h2>
            <p class="sec-text">{{ __('Browse our catalog and find what you need. Fast delivery across all 58 wilayas of Algeria.') }}</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3>{{ __('Nationwide Delivery') }}</h3>
                <p>{{ __('Fast and reliable delivery to all 58 wilayas.') }}</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>{{ __('Quality Products') }}</h3>
                <p>{{ __('Carefully curated products at great prices.') }}</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>{{ __('Customer Support') }}</h3>
                <p>{{ __('Dedicated support team ready to help.') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Stats Counter --}}
<section class="py-16 bg-[var(--color-theme,#F02801)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="counter-number text-white text-4xl md:text-5xl font-bold font-display">58</div>
                <p class="text-white/80 font-medium mt-2">{{ __('Wilayas Covered') }}</p>
            </div>
            <div>
                <div class="counter-number text-white text-4xl md:text-5xl font-bold font-display">10+</div>
                <p class="text-white/80 font-medium mt-2">{{ __('Premium Brands') }}</p>
            </div>
            <div>
                <div class="counter-number text-white text-4xl md:text-5xl font-bold font-display">100%</div>
                <p class="text-white/80 font-medium mt-2">{{ __('Electric') }}</p>
            </div>
            <div>
                <div class="counter-number text-white text-4xl md:text-5xl font-bold font-display">24/7</div>
                <p class="text-white/80 font-medium mt-2">{{ __('Customer Support') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
