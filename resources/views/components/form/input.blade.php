@props([
'label' => '',
'type' => 'text',
'name' => '',
'placeholder' => '',
'value' => '',
'wireModel' => null,
])

<div class="mb-4">
    @if($label)
    <label class="block text-gray-800 dark:text-gray-200 font-semibold mb-1" for="{{ $name }}">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}"
        {{ $wireModel ? "wire:model={$wireModel}" : '' }} {{ $attributes->merge(['class' => 'w-full p-2 border
    border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-dark-800 text-gray-900 dark:text-dark-50']) }}
    >
    {{ $slot }}
</div>