@extends('layouts.app')

@section('title', __('Compare'))

@section('content')
<div class="pt-24 pb-16 bg-white dark:bg-dark-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="section-title">{{ __('Compare') }}</h1>
            <p class="section-subtitle text-left mt-2">{{ __('Compare up to 4 motorcycles side by side to find your perfect ride.') }}</p>
        </div>

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 text-sm">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-moto-50 dark:bg-moto-900/20 border border-moto-200 dark:border-moto-800 text-moto-700 dark:text-moto-300 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(isset($products) && $products->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="p-4 text-left text-sm font-semibold text-surface-500 dark:text-dark-400 w-48"></th>
                            @foreach($products as $product)
                                <th class="p-4 text-center min-w-[200px]">
                                    <div class="glass-card p-4">
                                        <div class="aspect-square rounded-xl bg-surface-50 dark:bg-dark-800 overflow-hidden mb-3">
                                            @if($product->images->first())
                                                <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        @if($product->brand)
                                            <p class="text-xs font-medium text-moto-600 dark:text-moto-400">{{ $product->brand->name }}</p>
                                        @endif
                                        <h3 class="font-semibold text-surface-900 dark:text-white text-sm mt-1">{{ $product->title }}</h3>
                                        <p class="text-lg font-bold text-surface-900 dark:text-white mt-2">{{ number_format($product->price, 0) }} DZD</p>
                                        <div class="flex items-center justify-center gap-2 mt-3">
                                            <a href="{{ route('products.show', $product->slug) }}" class="btn-ghost text-xs px-3 py-1.5">{{ __('View Details') }}</a>
                                            <form action="{{ route('compare.remove', $product) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-xs text-red-500 hover:text-red-700 px-3 py-1.5">{{ __('Remove') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($comparisonDTO) && $comparisonDTO->specificationGroups->count() > 0)
                            @foreach($comparisonDTO->specificationGroups as $group => $specs)
                                <tr>
                                    <td colspan="{{ $products->count() + 1 }}" class="p-4 pt-8">
                                        <h4 class="font-bold text-surface-900 dark:text-white text-lg">{{ $group }}</h4>
                                    </td>
                                </tr>
                                @foreach($specs as $spec)
                                    <tr class="border-t border-surface-100 dark:border-dark-700">
                                        <td class="p-4 text-sm font-medium text-surface-500 dark:text-dark-300">{{ $spec['label'] }}</td>
                                        @foreach($products as $product)
                                            <td class="p-4 text-center text-sm font-medium text-surface-900 dark:text-white">
                                                {{ $comparisonDTO->getValue($product, $group, $spec['label']) ?? '-' }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-20">
                <svg class="w-16 h-16 mx-auto text-surface-300 dark:text-dark-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <h3 class="text-xl font-semibold text-surface-900 dark:text-white mb-2">{{ __('No products to compare') }}</h3>
                <p class="text-surface-500 dark:text-dark-300 mb-6">{{ __('Add products from the catalog to compare them side by side.') }}</p>
                <a href="{{ route('catalog') }}" class="btn-primary">{{ __('Browse Catalog') }}</a>
            </div>
        @endif
    </div>
</div>
@endsection
