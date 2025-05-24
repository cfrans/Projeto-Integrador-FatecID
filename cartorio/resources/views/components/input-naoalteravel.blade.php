@props(['disabled' => false])

<input
    type="text"
    readonly
    
    {{ $attributes->merge(['class' => '
        border
        bg-gray-100
        text-gray-700
        rounded-md
        shadow-sm
        cursor-not-allowed
    ']) }}
    @disabled($disabled)
/>
