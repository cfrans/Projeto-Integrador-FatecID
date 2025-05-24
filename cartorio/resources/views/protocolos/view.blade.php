<x-app-layout>
    <!-- Slot do título da aba do navegador -->
    <x-slot name="title">Visualizar protocolo</x-slot>

    <!-- Slot do cabeçalho visual no topo da página -->
    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">
            {{ __('Visualização') }}
        </h2>
    </x-slot>

    View protocolos
</x-app-layout>
