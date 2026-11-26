<div class="bg-white dark:bg-dark-800 rounded-2xl shadow-lg border border-surface-100 dark:border-dark-700 overflow-hidden">
    <div class="p-6 bg-surface-50 dark:bg-dark-900 border-b border-surface-100 dark:border-dark-700">
        <h3 class="font-bold text-surface-900 dark:text-white text-lg">Order Form</h3>
        <p class="text-sm text-surface-500 dark:text-dark-300 mt-1">Fill in your details to place your order.</p>
    </div>

    @if(session('message'))
        <div class="m-6 p-4 rounded-xl bg-moto-50 dark:bg-moto-900/20 border border-moto-200 dark:border-moto-800">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-moto-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-moto-700 dark:text-moto-300 font-medium">{{ session('message') }}</p>
            </div>
        </div>
    @endif

    <form wire:submit="submitOrder" class="p-6 space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-surface-700 dark:text-dark-200 mb-1.5">Full Name</label>
                <input wire:model="name" type="text" class="input-field" placeholder="Your name">
                @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-surface-700 dark:text-dark-200 mb-1.5">Phone Number</label>
                <input wire:model="phone" type="tel" class="input-field" placeholder="0555XXXXXX">
                @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-surface-700 dark:text-dark-200 mb-1.5">Confirm Phone</label>
                <input wire:model="confirmPhone" type="tel" class="input-field" placeholder="Repeat phone number">
                @error('confirmPhone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-surface-700 dark:text-dark-200 mb-1.5">Wilaya</label>
                <select wire:model="wilaya_code" wire:change="updateWilayaCodeHandler" class="input-field">
                    <option value="">Select Wilaya</option>
                    @foreach($wilayas as $wilaya)
                        <option value="{{ $wilaya->wilaya_code }}">{{ $wilaya->wilaya_name_fr }}</option>
                    @endforeach
                </select>
                @error('wilaya_code') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-surface-700 dark:text-dark-200 mb-1.5">Commune</label>
                <select wire:model="commune_id" class="input-field">
                    <option value="">Select Commune</option>
                    @foreach($communes as $commune)
                        <option value="{{ $commune['id'] }}">{{ $commune['commune_name_fr'] }}</option>
                    @endforeach
                </select>
                @error('commune_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-surface-700 dark:text-dark-200 mb-1.5">Delivery Method</label>
                <select wire:model="delivery_method" wire:change="updatedDeliveryMethod" class="input-field">
                    <option value="Door">Door Delivery</option>
                    <option value="StopDesk">Stop Desk</option>
                </select>
            </div>
        </div>

        <div class="pt-4 border-t border-surface-100 dark:border-dark-700 space-y-3">
            <div class="flex justify-between text-sm">
                <span class="text-surface-500 dark:text-dark-300">Product Price</span>
                <span class="font-medium text-surface-900 dark:text-white">{{ number_format($product->price, 2) }} DZD</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-surface-500 dark:text-dark-300">Delivery Price</span>
                <span class="font-medium text-surface-900 dark:text-white">{{ number_format($deliveryPrice, 2) }} DZD</span>
            </div>
            <div class="flex justify-between text-lg font-bold pt-3 border-t border-surface-100 dark:border-dark-700">
                <span class="text-surface-900 dark:text-white">Total</span>
                <span class="text-moto-600">{{ number_format($totalPrice, 2) }} DZD</span>
            </div>
        </div>

        <button type="submit" class="btn-primary w-full py-4 text-base">
            Place Order
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </button>
    </form>
</div>
