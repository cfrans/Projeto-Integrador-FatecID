@props(['disabled' => false, 'value' => ''])

<div class="relative inline-block w-full">
  <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-700 pointer-events-none select-none">
    R$
  </span>
  <input
    type="text"
    value="{{ $value }}"
    {{ $attributes->merge(['class' => '
        border-none
        bg-[#f5f5f5]
        text-gray-700
        rounded-md
        shadow-sm
        pl-10
        pr-3
        py-2
    ']) }}
    @disabled($disabled)
  />
</div>