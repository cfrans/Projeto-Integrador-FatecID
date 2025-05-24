<x-app-layout>
    <!-- Slot de título da aba do navegador -->
    <x-slot name="title">Autenticação</x-slot>

    <style>
        .campo-formulario {
            border: 0px;
            padding: 8px;
        }
    </style>

    <!-- Slot de cabeçalho visual da página -->
    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">
            {{ __('Autenticação') }}
        </h2>
    </x-slot>

    {{-- TODO: Criar o endpoint para o formulario --}}
    <form action="/endpoint" method="post">

        {{-- DIV MENOR PARA O CONTEUDO DOS CAMPOS --}}
        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-t-md">

        <!-- Primeira coluna (1/7) -->
            <div class="campo-formulario flex items-center ml-6"> 
                <div class="text-left">
                    <x-input-label for="autenticacao_data">
                        Data
                    </x-input-label>
                    <x-input-naoalteravel id="autenticacao_data" name="autenticacao_data" class="w-[200px] h-7.5 text-sm">
                    </x-input-naoalteravel>
                </div>
            </div>

            <!-- Segunda coluna (2/7) -->
             <div class="campo-formulario flex items-center ml-6"> 
                <div class="text-left">
                    <x-input-label for="autenticacao_hora">
                        Hora
                    </x-input-label>
                    <x-input-naoalteravel id="autenticacao_hora" name="autenticacao_hora" class="w-[200px] h-7.5 text-sm">
                    </x-input-naoalteravel>
                </div>
            </div>  

            <!-- Terceira coluna (3/7) -->
             <div class="campo-formulario flex items-center ml-6"> 
                <div class="text-left">
                    <x-input-label for="autenticacao_usuario">
                        Usúario
                    </x-input-label>
                    <x-input-naoalteravel id="nome" name="nome" class="mt-1 block w-full" value="{{ Auth::user() ? Auth::user()->nome : '' }}" readonly />
                </div>
            </div>

            <!-- Quarta coluna (4/7) -->
            <div class="campo-formulario flex items-center ml-6"> 
                <div class="text-left">
                    <x-input-label for="autenticacao_grupo">
                        Grupo
                    </x-input-label>
                    <x-input-naoalteravel id="protocolo_natureza" name="protocolo_natureza" class="w-[200px] h-7.5 text-sm">
                    </x-input-naoalteravel>
                </div>
            </div>

            <!-- Quinta coluna (5/7) -->
           <div class="campo-formulario flex items-center ml-6"> 
                <div class="text-left">
                    <x-input-label for="autenticacao_apresentante">
                        Apresentante
                    </x-input-label>
                    <x-input-naoalteravel id="apresentante_nome" name="apresentante_nome" class="w-[200px] h-7.5 text-sm">
                    </x-input-naoalteravel>
                </div>
            </div>

            <!-- Sexta coluna (6/7) -->
            <div class="campo-formulario flex items-center"> 
                <div class="text-left">
                    <x-input-label for="autenticacao_valor">
                        Valor
                    </x-input-label>
                        <x-input-number type="text" id="valor" name="valor" class="w-[200px] h-8 text-sm" required>
                        </x-input-number>
                </div>
            </div>


        </div> 

</x-app-layout>
