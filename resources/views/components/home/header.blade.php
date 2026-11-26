<header
    x-data="{
        mobileMenuOpen: false,
        searchOpen: false,
        searchQuery: '',
        searchResults: [],
        searchTimeout: null,
        cartCount: 0,
        scrollY: 0,
        isScrolled: false,
        dark: document.documentElement.classList.contains('dark'),
        init() {
            window.addEventListener('scroll', () => {
                this.scrollY = window.scrollY;
                this.isScrolled = window.scrollY > 50;
            });
        },
        toggleTheme() {
            this.dark = !this.dark;
            document.documentElement.classList.toggle('dark', this.dark);
            localStorage.setItem('theme', this.dark ? 'dark' : 'light');
        },
        toggleMobileMenu() {
            this.mobileMenuOpen = !this.mobileMenuOpen;
            document.body.style.overflow = this.mobileMenuOpen ? 'hidden' : '';
        },
        toggleSearch() {
            this.searchOpen = !this.searchOpen;
            if (this.searchOpen) {
                this.$nextTick(() => this.$refs.searchInput?.focus());
            } else {
                this.searchResults = [];
                this.searchQuery = '';
            }
        },
        async liveSearch() {
            if (this.searchTimeout) clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(async () => {
                if (this.searchQuery.length < 2) { this.searchResults = []; return; }
                try {
                    const r = await fetch('/search/live?q=' + encodeURIComponent(this.searchQuery));
                    this.searchResults = await r.json();
                } catch { this.searchResults = []; }
            }, 300);
        },
        closeSearch() {
            this.searchOpen = false;
            this.searchResults = [];
            this.searchQuery = '';
        },
    }"
    x-on:keydown.escape="closeSearch"
    class="fixed top-0 inset-x-0 z-50 bg-white/95 dark:bg-dark-950/95 backdrop-blur-xl border-b border-surface-100 dark:border-dark-800 transition-all duration-300"
    x-bind:class="{ 'shadow-lg': isScrolled }"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20">
            <div class="flex items-center gap-8 rtl:gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-[var(--color-theme,#F02801)] flex items-center justify-center">
                        <span class="text-white font-bold text-sm">M+</span>
                    </div>
                    <span class="font-display font-bold text-xl tracking-tight text-[#121212] dark:text-white">MotoPlus</span>
                </a>

                <nav class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('catalog') }}" class="font-display text-sm font-bold uppercase px-4 py-2 text-surface-600 dark:text-dark-200 hover:text-[var(--color-theme,#F02801)] dark:hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Catalog') }}</a>
                    <a href="{{ route('brands.index') }}" class="font-display text-sm font-bold uppercase px-4 py-2 text-surface-600 dark:text-dark-200 hover:text-[var(--color-theme,#F02801)] dark:hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Brands') }}</a>
                    <a href="{{ route('services') }}" class="font-display text-sm font-bold uppercase px-4 py-2 text-surface-600 dark:text-dark-200 hover:text-[var(--color-theme,#F02801)] dark:hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('Services') }}</a>
                    <a href="{{ route('faq') }}" class="font-display text-sm font-bold uppercase px-4 py-2 text-surface-600 dark:text-dark-200 hover:text-[var(--color-theme,#F02801)] dark:hover:text-[var(--color-theme,#F02801)] transition-colors">{{ __('FAQ') }}</a>
                </nav>
            </div>

            <div class="flex items-center gap-2 rtl:gap-2">
                <div class="relative" x-data="{ langOpen: false }">
                    <button @click="langOpen = !langOpen" class="font-display text-sm font-bold uppercase px-3 py-2 text-surface-600 dark:text-dark-200 hover:text-[var(--color-theme,#F02801)] transition-colors" aria-label="{{ __('Language') }}">
                        {{ app()->getLocale() }}
                    </button>
                    <div x-show="langOpen" x-cloak @click.outside="langOpen = false" class="absolute mt-2 w-36 rounded-xl bg-white dark:bg-dark-900 shadow-lg border border-surface-100 dark:border-dark-800 py-2 z-50 right-0 rtl:left-0 rtl:right-auto">
                        <a href="{{ route('locale.switch', 'fr') }}" class="block px-4 py-2 text-sm text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('French') }}</a>
                        <a href="{{ route('locale.switch', 'en') }}" class="block px-4 py-2 text-sm text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('English') }}</a>
                        <a href="{{ route('locale.switch', 'ar') }}" class="block px-4 py-2 text-sm text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('Arabic') }}</a>
                    </div>
                </div>

                <button @click="toggleSearch()" class="btn-ghost p-2.5" aria-label="Search">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                <button @click="toggleTheme" class="btn-ghost p-2.5 relative" aria-label="Toggle theme">
                    <svg x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg x-show="dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </button>

                <a href="{{ route('compare') }}" class="btn-ghost p-2.5 relative" aria-label="Compare">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </a>

                <a href="{{ route('catalog') }}" class="btn-ghost p-2.5 relative" aria-label="Cart">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                    </svg>
                    <span x-show="cartCount > 0" x-text="cartCount" class="absolute -top-0.5 -right-0.5 w-4 h-4 rounded-full bg-[var(--color-theme,#F02801)] text-white text-[10px] font-bold flex items-center justify-center"></span>
                </a>

                <button @click="toggleMobileMenu()" class="btn-ghost p-2.5 lg:hidden" aria-label="Menu">
                    <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Search Dropdown --}}
    <div
        x-show="searchOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="border-t border-surface-100 dark:border-dark-800 bg-white dark:bg-dark-950"
    >
        <div class="max-w-3xl mx-auto px-4 py-4">
            <div class="relative">
                <svg class="absolute w-5 h-5 text-surface-400 dark:text-dark-400 top-1/2 -translate-y-1/2 left-4 rtl:left-auto rtl:right-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    x-ref="searchInput"
                    x-model="searchQuery"
                    x-on:input.debounce="liveSearch()"
                    type="text"
                    placeholder="{{ __('Search') }}"
                    class="w-full rounded-xl border border-surface-200 dark:border-dark-700 bg-surface-50 dark:bg-dark-800 text-surface-900 dark:text-white placeholder-surface-400 dark:placeholder-dark-400 focus:outline-none focus:ring-2 focus:ring-[var(--color-theme,#F02801)]/40 focus:border-[var(--color-theme,#F02801)] transition-all pl-12 rtl:pl-4 rtl:pr-12 pr-4"
                >
                <button @click="closeSearch()" class="absolute top-1/2 -translate-y-1/2 text-surface-400 dark:text-dark-400 hover:text-surface-600 dark:hover:text-dark-200 right-4 rtl:right-auto rtl:left-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div x-show="searchResults.length > 0" x-cloak class="mt-4 space-y-2">
                <template x-for="result in searchResults" :key="result.slug">
                    <a :href="`/products/${result.slug}`" @click="closeSearch()" class="flex items-center gap-4 p-3 rounded-xl hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">
                        <img x-show="result.image" :src="result.image" class="w-12 h-12 rounded-lg object-cover bg-surface-100 dark:bg-dark-800" alt="">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-surface-900 dark:text-white truncate" x-text="result.title"></p>
                            <p class="text-sm text-surface-500 dark:text-dark-300" x-text="result.brand ? result.brand + ' · ' + result.price : result.price"></p>
                        </div>
                    </a>
                </template>
            </div>

            <div x-show="searchQuery.length >= 2 && searchResults.length === 0" class="mt-4 text-center py-8 text-surface-400 dark:text-dark-400">
                <p>{{ __('No results found for') }} "<span x-text="searchQuery"></span>"</p>
            </div>

            <div x-show="searchQuery.length >= 2" class="mt-4 text-center">
                <a :href="`/search?q=${encodeURIComponent(searchQuery)}`" @click="closeSearch()" class="text-sm font-medium text-[var(--color-theme,#F02801)] hover:text-[var(--color-theme,#F02801)]/80">
                    {{ __('View all results') }} →
                </a>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div
        x-show="mobileMenuOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="lg:hidden border-t border-surface-100 dark:border-dark-800 bg-white dark:bg-dark-950"
    >
        <div class="px-4 py-4 space-y-1">
            <a href="{{ route('catalog') }}" @click="toggleMobileMenu()" class="block px-4 py-3 rounded-xl font-display font-bold uppercase text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('Catalog') }}</a>
            <a href="{{ route('brands.index') }}" @click="toggleMobileMenu()" class="block px-4 py-3 rounded-xl font-display font-bold uppercase text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('Brands') }}</a>
            <a href="{{ route('services') }}" @click="toggleMobileMenu()" class="block px-4 py-3 rounded-xl font-display font-bold uppercase text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('Services') }}</a>
            <a href="{{ route('about') }}" @click="toggleMobileMenu()" class="block px-4 py-3 rounded-xl font-display font-bold uppercase text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('About') }}</a>
            <a href="{{ route('contact') }}" @click="toggleMobileMenu()" class="block px-4 py-3 rounded-xl font-display font-bold uppercase text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('Contact') }}</a>
            <a href="{{ route('faq') }}" @click="toggleMobileMenu()" class="block px-4 py-3 rounded-xl font-display font-bold uppercase text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('FAQ') }}</a>
            <hr class="my-2 border-surface-100 dark:border-dark-800">
            <button @click="toggleTheme" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">
                <svg x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                <svg x-show="dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span x-text="dark ? '{{ __('Light Mode') }}' : '{{ __('Dark Mode') }}'"></span>
            </button>
            <div class="text-sm font-medium text-surface-500 dark:text-dark-400 px-4 py-2">{{ __('Language') }}</div>
            <a href="{{ route('locale.switch', 'fr') }}" @click="toggleMobileMenu()" class="block px-4 py-3 rounded-xl font-medium text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('French') }}</a>
            <a href="{{ route('locale.switch', 'en') }}" @click="toggleMobileMenu()" class="block px-4 py-3 rounded-xl font-medium text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('English') }}</a>
            <a href="{{ route('locale.switch', 'ar') }}" @click="toggleMobileMenu()" class="block px-4 py-3 rounded-xl font-medium text-surface-700 dark:text-dark-200 hover:bg-surface-50 dark:hover:bg-dark-800 transition-colors">{{ __('Arabic') }}</a>
        </div>
    </div>
</header>
