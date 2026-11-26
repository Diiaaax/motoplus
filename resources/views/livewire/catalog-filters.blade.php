<div class="bg-white dark:bg-dark-800 rounded-2xl border border-surface-100 dark:border-dark-700 p-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
        <div class="lg:col-span-2">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search products..."
                class="input-field"
            >
        </div>

        <div>
            <select wire:model.live="vehicleType" class="input-field">
                <option value="">All Types</option>
                <option value="motorcycle">Motorcycles</option>
                <option value="scooter">Scooters</option>
                <option value="battery">Batteries</option>
                <option value="charger">Chargers</option>
                <option value="accessory">Accessories</option>
                <option value="spare_part">Spare Parts</option>
            </select>
        </div>

        <div>
            <select wire:model.live="category" class="input-field">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <select wire:model.live="brand" class="input-field">
                <option value="">All Brands</option>
                @foreach($brands as $b)
                    <option value="{{ $b->slug }}">{{ $b->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-2">
            <button wire:click="applyFilters" class="btn-primary flex-1">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filter
            </button>
            <button wire:click="resetFilters" class="btn-ghost">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </button>
        </div>
    </div>

    @if(request()->hasAny(['search', 'category', 'brand', 'vehicle_type', 'min_price', 'max_price']))
        <div class="mt-4 flex flex-wrap gap-2">
            @if(request('search'))
                <span class="badge-blue flex items-center gap-1">
                    Search: "{{ request('search') }}"
                    <a href="{{ request()->fullUrlWithoutQuery(['search']) }}" class="ml-1 hover:text-white">&times;</a>
                </span>
            @endif
            @if(request('category'))
                <span class="badge-green flex items-center gap-1">
                    {{ request('category') }}
                    <a href="{{ request()->fullUrlWithoutQuery(['category']) }}" class="ml-1 hover:text-white">&times;</a>
                </span>
            @endif
            @if(request('brand'))
                <span class="badge-amber flex items-center gap-1">
                    {{ request('brand') }}
                    <a href="{{ request()->fullUrlWithoutQuery(['brand']) }}" class="ml-1 hover:text-white">&times;</a>
                </span>
            @endif
        </div>
    @endif
</div>
