<div>
    <div class="space-y-5"
        x-data="{ 
            localStatus: @entangle('status'),
            sending: false
         }"
         x-init="window.addEventListener('resetSendButton', () => { sending = false })">
        
        <h3 class="font-bold text-surface-900 dark:text-white text-lg">{{ __('Contact') }}</h3>

        <div>
            <input type="text" wire:model.defer="name" placeholder="{{ __('Your name') }}"
                class="input-field" />
            @error('name')
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <input type="email" wire:model.defer="email" placeholder="{{ __('Your email') }}"
                class="input-field" />
            @error('email')
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <input type="text" wire:model.defer="phone" placeholder="{{ __('Phone number') }}" maxlength="10" inputmode="numeric" pattern="\d*"
                class="input-field" />
            @error('phone')
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <textarea wire:model.defer="message" rows="4" placeholder="{{ __('Your feedback...') }}"
                class="input-field resize-none"></textarea>
            @error('message')
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-between gap-4 pt-2">
            <div class="flex gap-2">
                <button type="button" @click="localStatus = 1" wire:click="$set('status', 1)"
                    x-bind:class="localStatus === 1 ? 'bg-moto-500 text-white border-moto-500' : 'bg-surface-100 text-surface-500 dark:bg-dark-700 dark:text-dark-300 border-surface-200 dark:border-dark-600'"
                    class="flex items-center justify-center rounded-lg p-2.5 border transition-colors" aria-label="Happy">
                    <svg viewBox="0 0 512 512" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg">
                        <path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm177.6 62.1C192.8 334.5 218.8 352 256 352s63.2-17.5 78.4-33.9c9-9.7 24.2-10.4 33.9-1.4s10.4 24.2 1.4 33.9c-22 23.8-60 49.4-113.6 49.4s-91.7-25.5-113.6-49.4c-9-9.7-8.4-24.9 1.4-33.9s24.9-8.4 33.9 1.4zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                    </svg>
                </button>

                <button type="button" @click="localStatus = 0" wire:click="$set('status', 0)"
                    x-bind:class="localStatus === 0 ? 'bg-moto-500 text-white border-moto-500' : 'bg-surface-100 text-surface-500 dark:bg-dark-700 dark:text-dark-300 border-surface-200 dark:border-dark-600'"
                    class="flex items-center justify-center rounded-lg p-2.5 border transition-colors" aria-label="Sad">
                    <svg viewBox="0 0 512 512" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg">
                        <path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM174.6 384.1c-4.5 12.5-18.2 18.9-30.7 14.4s-18.9-18.2-14.4-30.7C146.9 319.4 198.9 288 256 288s109.1 31.4 126.6 79.9c4.5 12.5-2 26.2-14.4 30.7s-26.2-2-30.7-14.4C328.2 358.5 297.2 336 256 336s-72.2 22.5-81.4 48.1zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                    </svg>
                </button>
            </div>

            <button type="button" @click="sending = true" wire:click="submit" :disabled="sending"
                x-bind:class="sending ? 'bg-moto-400 cursor-wait' : 'bg-moto-600 hover:bg-moto-700'"
                class="btn-primary flex-grow max-w-[200px]">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7.4 6.32 15.89 3.49C19.7 2.22 21.77 4.3 20.51 8.11L17.68 16.6C15.78 22.31 12.66 22.31 10.76 16.6L9.92 14.08 7.4 13.24C1.69 11.34 1.69 8.23 7.4 6.32Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.11 13.65 13.69 10.06" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span x-text="sending ? '{{ __("Sending...") }}' : '{{ __("Send") }}'"></span>
            </button>
        </div>

        @error('status')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror

        @if ($success)
            <div class="p-4 rounded-xl bg-moto-50 dark:bg-moto-900/20 border border-moto-200 dark:border-moto-800">
                <p class="text-moto-700 dark:text-moto-300 font-medium text-sm">{{ $success }}</p>
            </div>
        @endif
    </div>
</div>
