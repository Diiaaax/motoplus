@extends('layouts.app')

@section('title', __('About'))

@section('content')
<div class="pt-24 pb-16 bg-white dark:bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="section-title">{{ __('About') }} MotoPlus</h1>
            <p class="section-subtitle">{{ __('Premium Electric Motorcycles Algeria') }}</p>
        </div>

        <div class="glass-card p-8 md:p-12 mb-12">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h2 class="text-2xl font-display font-bold text-surface-900 dark:text-white mb-4">{{ __('Our Story') }}</h2>
                    <p class="text-surface-500 dark:text-dark-300 leading-relaxed mb-4">
                        {{ __('MotoPlus was founded with a simple mission: to bring the future of urban mobility to Algeria.') }}
                    </p>
                    <p class="text-surface-500 dark:text-dark-300 leading-relaxed">
                        {{ __('We partner with leading global brands to ensure our customers get the best in quality.') }}
                    </p>
                </div>
                <div class="aspect-square rounded-2xl bg-surface-50 dark:bg-dark-800 flex items-center justify-center">
                    <svg class="w-32 h-32 text-moto-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <div class="text-center p-8">
                <div class="text-4xl font-bold text-moto-600 mb-2">58</div>
                <p class="font-semibold text-surface-900 dark:text-white">{{ __('Wilayas Covered') }}</p>
                <p class="text-sm text-surface-500 dark:text-dark-300 mt-1">{{ __('Nationwide delivery across Algeria') }}</p>
            </div>
            <div class="text-center p-8">
                <div class="text-4xl font-bold text-moto-600 mb-2">10+</div>
                <p class="font-semibold text-surface-900 dark:text-white">{{ __('Premium Brands') }}</p>
                <p class="text-sm text-surface-500 dark:text-dark-300 mt-1">{{ __("World's leading EV manufacturers") }}</p>
            </div>
            <div class="text-center p-8">
                <div class="text-4xl font-bold text-moto-600 mb-2">100%</div>
                <p class="font-semibold text-surface-900 dark:text-white">{{ __('Electric') }}</p>
                <p class="text-sm text-surface-500 dark:text-dark-300 mt-1">{{ __('Zero emissions, infinite freedom') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
