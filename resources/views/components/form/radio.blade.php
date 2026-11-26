<div class="flex p-2 gap-4 w-full">
    <!-- Door delivery option -->
    <label for="door" class="cursor-pointer flex-1">
        <input class="peer sr-only" value="Door" name="delivery_method" id="door" type="radio"
            wire:model.defer="delivery_method" />
        <div
            class="flex h-16 w-full flex-col items-center justify-center rounded-xl border-2 border-gray-300 dark:border-dark-600 bg-gray-50 dark:bg-dark-800 p-1 transition-transform duration-150 hover:border-moto-400 active:scale-95 peer-checked:border-moto-600 peer-checked:shadow-md peer-checked:shadow-moto-300">

            <div class="flex items-center justify-center space-x-2 text-sm font-semibold uppercase text-gray-600 dark:text-dark-300 peer-checked:text-moto-600">
                <span class="text-xl">🏠</span>
                <span>Home Delivery</span>
            </div>
        </div>
    </label>

    <!-- Pickup delivery option -->
    <label for="pickup" class="cursor-pointer flex-1">
        <input class="peer sr-only" value="StopDesk" name="delivery_method" id="pickup" type="radio"
            wire:model.defer="delivery_method" />
        <div
            class="flex h-16 w-full flex-col items-center justify-center rounded-xl border-2 border-gray-300 dark:border-dark-600 bg-gray-50 dark:bg-dark-800 p-1 transition-transform duration-150 hover:border-moto-400 active:scale-95 peer-checked:border-moto-600 peer-checked:shadow-md peer-checked:shadow-moto-300">

            <div class="flex items-center justify-center space-x-2 text-sm font-semibold uppercase text-gray-600 dark:text-dark-300 peer-checked:text-moto-600">
                <span class="text-xl">📦</span>
                <span>Stopdesk</span>
            </div>
        </div>
    </label>
</div>