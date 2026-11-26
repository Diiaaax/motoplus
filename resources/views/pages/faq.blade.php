@extends('layouts.app')

@section('title', __('FAQ'))

@section('content')
<div class="pt-24 pb-16 bg-white dark:bg-dark-950">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="section-title">{{ __('Frequently Asked Questions') }}</h1>
            <p class="section-subtitle">{{ __('Premium Electric Motorcycles Algeria') }}</p>
        </div>

        @if(isset($faqs) && $faqs->count() > 0)
            <div x-data="{ openItem: null, toggle(index) { this.openItem = this.openItem === index ? null : index; } }" class="space-y-6">
                @foreach($faqs as $category => $categoryFaqs)
                    @if($category)
                        <h2 class="text-xl font-bold text-surface-900 dark:text-white mt-10 mb-4 {{ $loop->first ? '' : '' }}">{{ $category }}</h2>
                    @endif

                    @foreach($categoryFaqs as $index => $faq)
                        @php $faqKey = $category . '_' . $index; @endphp
                        <div class="glass-card overflow-hidden">
                            <button
                                @click="toggle('{{ $faqKey }}')"
                                class="w-full flex items-center justify-between p-6 text-left"
                            >
                                <span class="font-medium text-surface-900 dark:text-white pr-4">{{ $faq->question }}</span>
                                <svg
                                    class="w-5 h-5 text-surface-400 dark:text-dark-400 flex-shrink-0 transition-transform duration-300"
                                    :class="{ 'rotate-180': openItem === '{{ $faqKey }}' }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div
                                x-show="openItem === '{{ $faqKey }}'"
                                x-collapse
                                class="px-6 pb-6"
                            >
                                <p class="text-surface-500 dark:text-dark-300 leading-relaxed">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-surface-500 dark:text-dark-300">{{ __('No FAQs available yet.') }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
