@props(['disabled' => false, 'value' => ''])

<input
    type="text"
    readonly
    value="{{ $value }}"
    {{ $attributes->merge(['class' => '
        border-none
        bg-gray-200
        text-gray-700
        rounded-md
        shadow-sm
        cursor-not-allowed
    ']) }}
    @disabled($disabled)
/>
