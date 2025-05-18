@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => '
        border-0
        bg-[#f5f5f5]
        dark:text-black-300
        focus:border-0
        focus:ring-0
        rounded-md
        shadow-sm
    ']) }}
/>
