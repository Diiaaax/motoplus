<section class="relative overflow-hidden bg-white dark:bg-dark-950 pt-24 md:pt-28" aria-label="Hero">
    <div class="absolute inset-0 bg-gradient-to-r from-[#f5f5f5] via-white to-white dark:from-dark-900 dark:via-dark-950 dark:to-dark-950 z-0"></div>

    <div class="relative z-[2] pb-12 md:pb-16 lg:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-6 lg:gap-0">
                <div class="w-full lg:w-1/2 text-center lg:text-left rtl:lg:text-right">
                    <span class="font-display text-[#52525b] dark:text-dark-200 text-xl md:text-2xl block mb-4">
                        {{ __('Starting From') }}
                    </span>
                    <span class="font-display text-[#121212] dark:text-white text-2xl md:text-[35px] font-bold block mb-6 md:mb-10">
                        {{ __('On Sale Now') }}
                    </span>
                    <h1 class="font-display text-[#121212] dark:text-white font-bold leading-[0.9] uppercase mb-5 text-[42px] md:text-[60px] lg:text-[80px] xl:text-[100px]">
                        NIU <span class="block text-[32px] md:text-[48px] lg:text-[64px] xl:text-[80px]">{{ __('NQi Sport') }}</span>
                    </h1>
                    <p class="font-display text-[#121212] dark:text-dark-200 text-base md:text-lg leading-relaxed max-w-lg mb-8 mx-auto lg:mx-0 rtl:lg:mx-auto">
                        {{ __('Discover the new NIU electric scooter — zero emissions, maximum freedom. Fast delivery across all 58 wilayas of Algeria.') }}
                    </p>
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start rtl:lg:justify-end">
                        <a href="{{ route('catalog') }}" class="btn-kars inline-flex items-center gap-2 px-8 py-4 font-display font-bold text-sm uppercase leading-none min-w-[130px] justify-center no-underline">
                            {{ __('Browse Catalog') }} <i class="fas fa-arrow-up-right rtl:fa-arrow-up-left"></i>
                        </a>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 flex justify-center lg:justify-end rtl:lg:justify-start mt-6 lg:mt-0">
                    <div class="lg:-mr-10 xl:-mr-20 rtl:lg:-ml-10 rtl:xl:-ml-20 rtl:lg:mr-0">
                        <img src="{{ asset('images/niu-scooter.webp') }}" alt="{{ __('NIU NQi Sport') }}" class="w-full h-auto max-w-sm md:max-w-md lg:max-w-none" fetchpriority="high" width="600" height="450">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
