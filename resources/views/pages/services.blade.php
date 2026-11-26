@extends('layouts.app')

@section('title', __('Services'))

@section('content')
<div class="pt-24 pb-16 bg-white dark:bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="section-title">{{ __('Our Services') }}</h1>
            <p class="section-subtitle">{{ __('Premium Electric Motorcycles Algeria') }}</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="glass-card p-8 text-center hover:-translate-y-1 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-moto-100 dark:bg-moto-900/20 flex items-center justify-center">
                    <svg class="w-8 h-8 text-moto-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-surface-900 dark:text-white mb-3">{{ __('Maintenance & Repair') }}</h3>
                <p class="text-sm text-surface-500 dark:text-dark-300 leading-relaxed">{{ __('Professional maintenance and repair services for all electric motorcycles and scooters. Certified technicians.') }}</p>
            </div>

            <div class="glass-card p-8 text-center hover:-translate-y-1 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-surface-900 dark:text-white mb-3">{{ __('Warranty Service') }}</h3>
                <p class="text-sm text-surface-500 dark:text-dark-300 leading-relaxed">{{ __('Comprehensive warranty coverage on all new vehicles. Quick and hassle-free warranty claims processing.') }}</p>
            </div>

            <div class="glass-card p-8 text-center hover:-translate-y-1 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-amber-100 dark:bg-amber-900/20 flex items-center justify-center">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-surface-900 dark:text-white mb-3">{{ __('Battery Replacement') }}</h3>
                <p class="text-sm text-surface-500 dark:text-dark-300 leading-relaxed">{{ __('Genuine battery replacements for all makes and models. Extended-life batteries with warranty included.') }}</p>
            </div>

            <div class="glass-card p-8 text-center hover:-translate-y-1 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-purple-100 dark:bg-purple-900/20 flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-surface-900 dark:text-white mb-3">{{ __('Delivery & Setup') }}</h3>
                <p class="text-sm text-surface-500 dark:text-dark-300 leading-relaxed">{{ __('Nationwide delivery to all 58 wilayas. Professional unpacking, assembly, and setup at your location.') }}</p>
            </div>

            <div class="glass-card p-8 text-center hover:-translate-y-1 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-red-100 dark:bg-red-900/20 flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-surface-900 dark:text-white mb-3">{{ __('Customer Support') }}</h3>
                <p class="text-sm text-surface-500 dark:text-dark-300 leading-relaxed">{{ __('Dedicated support team ready to help. Technical assistance, parts ordering, and general inquiries.') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
