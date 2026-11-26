@extends('layouts.app')

@section('title', __('Contact'))

@section('content')
<div class="pt-24 pb-16 bg-white dark:bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="section-title">{{ __('Contact') }}</h1>
            <p class="section-subtitle">{{ __('Premium Electric Motorcycles Algeria') }}</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            <div class="glass-card p-8">
                @livewire('contact-form')
            </div>

            <div class="space-y-8">
                <div class="glass-card p-8">
                    <h3 class="font-bold text-surface-900 dark:text-white mb-6">{{ __('Get in Touch') }}</h3>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-moto-100 dark:bg-moto-900/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-moto-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-surface-900 dark:text-white">Email</p>
                                <p class="text-sm text-surface-500 dark:text-dark-300">contact@motoplus.dz</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-moto-100 dark:bg-moto-900/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-moto-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-surface-900 dark:text-white">{{ __('Phone') }}</p>
                                <p class="text-sm text-surface-500 dark:text-dark-300">+213 (0) XXX-XXX-XXX</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-moto-100 dark:bg-moto-900/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-moto-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-surface-900 dark:text-white">{{ __('Address') }}</p>
                                <p class="text-sm text-surface-500 dark:text-dark-300">{{ __('Algiers, Algeria') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-8">
                    <h3 class="font-bold text-surface-900 dark:text-white mb-4">{{ __('Business Hours') }}</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-surface-500 dark:text-dark-300">{{ __('Saturday - Thursday') }}</span>
                            <span class="font-medium text-surface-900 dark:text-white">{{ __('9:00 AM - 6:00 PM') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-surface-500 dark:text-dark-300">{{ __('Friday') }}</span>
                            <span class="font-medium text-surface-900 dark:text-white">{{ __('Closed') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
