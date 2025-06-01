<x-app-layout>
    <x-slot name="title">Andamento</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">
            {{ __('Andamento') }}
        </h2>
    </x-slot>

    <style>
        .campo-formulario {
            border: 0px;
            padding: 8px;
        }
    </style>

    <div class="max-w-[75%] mx-auto w-full px-4">
        {{-- TODO: Criar o endpoint para o formulário --}}
        <form id="formulario" action="/protocolos" method="post">
            @csrf

            <div class="flex items-center justify-between w-[92%] h-20 mx-auto rounded-t-md px-6 mb-4">
    <!-- Campo de formulário -->
    <div class="campo-formulario flex items-center -ml-8">
        <div class="text-left">
            <x-input-label for="numero_documento">Protocolo</x-input-label>
            <x-input-naoalteravel id="numero_protocolo" name="numero_protocolo" class="w-[150px] h-8 text-sm">
            </x-input-naoalteravel>
        </div>
    </div>


    <!-- Botão de voltar -->
    <div class="w-9 h-9 bg-[#9f9f9f] rounded-full flex items-center justify-center">
    <button id="botao-voltar" type="button" onclick="window.location.href='{{ route('protocolos.view') }}'" class="w-full h-full flex items-center justify-center" >
        <img src="{{ asset('images/Voltar.png') }}" alt="Voltar" class="w-4 h-4" />
    </button>
</div>

</div>

        <div class="flex justify-start w-[92%] h-10 mx-auto bg-[#9f9f9f] rounded-t-md">
    <div class="text-left flex items-center ml-6 mr-16">
        <x-input-label for="numero_documento">Data/Hora</x-input-label>
    </div>

    <div class="text-left flex items-center mr-24 ">
        <x-input-label for="numero_documento">Tipo de Andamento</x-input-label>
    </div>

    <div class="text-left flex items-center mr-16">
        <x-input-label for="numero_documento">Valor</x-input-label>
    </div>

    <div class="text-left flex items-center mr-28" >
        <x-input-label for="numero_documento">Observação</x-input-label>
    </div>

    <div class="text-left flex items-center ml-28 ">
        <x-input-label for="numero_documento">Origem</x-input-label>
    </div>
</div>


            <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-t-md">
                <div class="campo-formulario flex items-center ml-4">
                    <div class="text-left">
                        <x-input-label for="numero_documento">Protocolo</x-input-label>
                        <x-text-input id="numero_documento" name="numero_documento" class="w-[200px] h-8 text-sm" required />
                    </div>
                </div>
            </div>



        </form>
    </div>
</x-app-layout>

