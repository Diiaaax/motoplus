<footer class="bg-[#121212] dark:bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Footer Top --}}
        <div class="py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-moto-600 flex items-center justify-center">
                            <span class="text-white font-bold text-sm">M+</span>
                        </div>
                        <span class="font-display font-bold text-xl tracking-tight">MotoPlus</span>
                    </a>
                    <p class="text-[#a3a3a3] text-sm leading-relaxed mb-6">
                        {{ __('Premium Electric Motorcycles Algeria') }}
                    </p>
                    <div class="flex gap-3">
                        <a href="{{ route('contact') }}" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-[var(--color-theme,#F02801)] transition-colors" aria-label="Facebook">
                            <i class="fab fa-facebook-f text-white text-sm"></i>
                        </a>
                        <a href="{{ route('contact') }}" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-[var(--color-theme,#F02801)] transition-colors" aria-label="Twitter">
                            <i class="fab fa-twitter text-white text-sm"></i>
                        </a>
                        <a href="{{ route('contact') }}" class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center hover:bg-[var(--color-theme,#F02801)] transition-colors" aria-label="Instagram">
                            <i class="fab fa-instagram text-white text-sm"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="widget-title">{{ __('Products') }}</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('catalog', ['vehicle_type' => 'motorcycle']) }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Electric Motorcycles') }}</a></li>
                        <li><a href="{{ route('catalog', ['vehicle_type' => 'scooter']) }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Electric Scooters') }}</a></li>
                        <li><a href="{{ route('catalog', ['vehicle_type' => 'battery']) }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Batteries') }}</a></li>
                        <li><a href="{{ route('catalog', ['vehicle_type' => 'charger']) }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Chargers') }}</a></li>
                        <li><a href="{{ route('catalog', ['vehicle_type' => 'accessory']) }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Accessories') }}</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="widget-title">{{ __('Company') }}</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('about') }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('About') }}</a></li>
                        <li><a href="{{ route('brands.index') }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Brands') }}</a></li>
                        <li><a href="{{ route('services') }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Services') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Contact') }}</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="widget-title">{{ __('Support') }}</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('faq') }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('FAQ') }}</a></li>
                        <li><a href="{{ route('terms') }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Terms & Conditions') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm text-[#a3a3a3] hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Support') }}</a></li>
                    </ul>

                    <div class="mt-8">
                        <h3 class="widget-title">{{ __('Newsletter') }}</h3>
                        <form action="{{ route('contact') }}" method="GET" class="flex gap-2">
                            <input type="email" name="email" placeholder="{{ __('Your email') }}" required class="flex-1 px-3 py-2.5 rounded-lg bg-white/10 border border-white/10 text-sm text-white placeholder-white/40 focus:outline-none focus:border-[var(--color-theme,#F02801)] transition-colors">
                            <button type="submit" class="btn-kars sm px-4 py-2 text-sm whitespace-nowrap min-w-0" aria-label="{{ __('Subscribe') }}">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="py-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-[#a3a3a3]">&copy; {{ date('Y') }} MotoPlus. {{ __('All rights reserved.') }}</p>
            <p class="text-sm text-[#a3a3a3]">{{ __('Algeria') }} &mdash; {{ __('Serving all 58 Wilayas') }}</p>
        </div>
    </div>
</footer>
