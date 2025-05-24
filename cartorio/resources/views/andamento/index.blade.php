<x-app-layout>
    <!-- Slot do título da página (usado geralmente no <title> da aba do navegador) -->
    <x-slot name="title">
        Andamento
    </x-slot>

    <!-- Slot de cabeçalho visual no topo da página -->
    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">
            {{ __('Andamento') }}
        </h2>
    </x-slot>

    <!-- Conteúdo da página -->
    Página de Andamento
</x-app-layout>
