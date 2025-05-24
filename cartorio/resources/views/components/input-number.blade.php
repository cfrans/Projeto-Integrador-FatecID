@props(['disabled' => false, 'value' => ''])

<div class="relative inline-block w-full">
  <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 pointer-events-none">
    R$
  </span>
  <input
    type="number"
    step="0.01"
    min="0"
    value="{{ $value }}"
    {{ $attributes->merge(['class' => 'pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500']) }}
    @disabled($disabled)
  />
</div>