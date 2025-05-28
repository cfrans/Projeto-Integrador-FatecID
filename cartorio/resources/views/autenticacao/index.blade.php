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
            <div class="flex justify-center items-start min-h-screen py-10 gap-5 bg-gray-100">

                <div class="flex flex-col gap-1 bg-white shadow-md rounded-md p-6 w-fit">
                    <div class ="flex flex-wrap justify-start w-full">
                    <!-- Primeira coluna (1/8) -->
                        <div class="campo-formulario flex items-center ml-6"> 
                            <div class="text-left">
                                <x-input-label for="autenticacao_data">
                                    Data
                                </x-input-label>
                                <x-input-naoalteravel id="autenticacao_data" name="autenticacao_data" class="w-[200px] h-10 text-sm">
                                </x-input-naoalteravel>
                            </div>
                        </div>

                        <!-- Segunda coluna (2/8) -->
                        <div class="campo-formulario flex items-center ml-6"> 
                            <div class="text-left">
                                <x-input-label for="autenticacao_hora">
                                    Hora
                                </x-input-label>
                                <x-input-naoalteravel id="autenticacao_hora" name="autenticacao_hora" class="w-[200px] h-10 text-sm">
                                </x-input-naoalteravel>
                            </div>
                        </div>  

                        <!-- Terceira coluna (3/8) -->
                        <div class="campo-formulario flex items-center ml-6"> 
                            <div class="text-left">
                                <x-input-label for="autenticacao_usuario">
                                    Usúario
                                </x-input-label>
                                <x-input-naoalteravel id="nome" name="nome" class="w-[200px] h-10 text-sm" value="{{ Auth::user() ? Auth::user()->nome : '' }}" readonly />
                            </div>
                        </div>
                    </div>

                    <div class ="flex flex-wrap justify-start w-full">
                        <!-- Quarta coluna (4/8) -->
                        <div class="campo-formulario flex items-center ml-6"> 
                            <div class="text-left">
                                <x-input-label for="autenticacao_grupo">
                                    Grupo
                                </x-input-label>
                                <x-input-naoalteravel id="protocolo_natureza" name="protocolo_natureza" class="w-[435px] h-10 text-sm">
                                </x-input-naoalteravel>
                            </div>
                        </div>

                        <!-- Quinta coluna (5/8) -->
                        <div class="campo-formulario flex items-center ml-6"> 
                            <div class="text-left">
                                <x-input-label for="autenticacao_protocolo">
                                    Protocolo
                                </x-input-label>
                                <x-input-naoalteravel id="autenticacao_protocolo" name="autenticacao_protocolo" class="w-[200px] h-10 text-sm">
                                </x-input-naoalteravel>
                            </div>
                        </div>
                    </div>

                    <div class ="flex flex-wrap justify-start w-full">
                        <!-- Quinta coluna (5/8) -->
                                <div class="campo-formulario flex items-center ml-6"> 
                                        <div class="text-left">
                                            <x-input-label for="autenticacao_apresentante">
                                                Apresentante
                                            </x-input-label>
                                            <x-input-naoalteravel id="apresentante_nome" name="apresentante_nome" class="w-[435px] h-10 text-sm">
                                            </x-input-naoalteravel>
                                        </div>
                                    </div>
                    
                        <!-- Sexta coluna (6/8) -->
                        <div class="campo-formulario flex items-center ml-6"> 
                            <div class="text-left">
                                <x-input-label for="autenticacao_valor">
                                    Valor
                                </x-input-label>
                                    <x-input-number type="text" id="valor" name="valor" class="w-[200px] h-10 text-sm" required>
                                    </x-input-number>
                            </div>
                        </div>
                    </div>

                    <div class ="flex flex-wrap justify-start w-full">
                            <!-- Sétima coluna (7/8) -->
                            <div class="campo-formulario flex items-center ml-6"> 
                                <div class="text-left">
                                    <x-input-label for="autenticacao_pagamento">
                                        Forma de Pagamento
                                    </x-input-label>
                                    <x-input-select id="id_forma_pagamento" name="id_forma_pagamento" class="w-[340px] h-10 text-sm" required>
                                        <option value="1">Dinheiro</option>
                                        <option value="2">Pix</option>
                                        <option value="3">Ted</option>
                                        <option value="4">Cheque</option>
                                    </x-input-select>
                                </div>
                            </div>

                            <!-- Oitava coluna (8/8) -->
                            <div class="campo-formulario flex items-center ml-6"> 
                                <div class="text-left">
                                    <x-input-label for="autenticacao_banco">
                                        Banco
                                    </x-input-label>
                                    <x-input-select id="id_banco" name="id_banco" class="w-[300px] h-10 text-sm" required>
                                        <option value="1">Caixa Econômica</option>
                                        <option value="2">Banco do Brasil</option>
                                        <option value="3">Itaú</option>
                                        <option value="4">Bradesco </option>
                                        <option value="5">Santander</option>
                                    </x-input-select>
                                </div>
                            </div>
                    </div>

                    <div class ="flex flex-wrap justify-start w-full">
                            <!-- Primeira coluna (1/3) -->
                            <div class="campo-formulario flex items-center ml-6"> 
                                <div class="text-left">
                                    <x-input-label for="autenticacao_conta">
                                        Conta
                                    </x-input-label>
                                    <x-text-input id="autenticacao_conta" name="autenticacao_conta" class="w-[200px] h-10 text-sm" required />
                                </div>
                            </div>

                            <!-- Segunda coluna (1/2) -->
                            <div class="campo-formulario flex items-center ml-6"> 
                                <div class="text-left">
                                    <x-input-label for="autenticacao_agencia">
                                        Agência
                                    </x-input-label>
                                    <x-text-input id="autenticacao_agencia" name="autenticacao_agencia" class="w-[200px] h-10 text-sm" required />
                                </div>
                            </div>

                            <!-- Terceira coluna (3/2) -->
                            <div class="campo-formulario flex items-center ml-6"> 
                                <div class="text-left">
                                    <x-input-label for="autenticacao_cheque">
                                        Número do cheque
                                    </x-input-label>
                                    <x-text-input id="autenticacao_cheque" name="autenticacao_cheque" class="w-[200px] h-10 text-sm" required />
                                </div>
                            </div>
                    </div>
                </div>
                <div class="flex flex-col gap-1 bg-white shadow-md rounded-md p-6 w-fit">
                    <div class ="flex flex-wrap justify-start w-full">    

                        <!-- Valor Prévio -->
                        <div class="campo-formulario flex items-center ml-6"> 
                            <div class="text-left">
                                <x-input-label for="autenticacao_valor_previo">
                                    Valor Prévio:
                                </x-input-label>
                                <x-input-number type="text" id="valor" name="valor" class="w-[200px] h-10 text-sm" readonly required />
                            </div>
                        </div>  

                        <!-- Valor Pago -->
                        <div class="campo-formulario flex items-center ml-6"> 
                                <div class="text-left">
                                    <x-input-label for="autenticacao_valor_pago">
                                        Valor Pago:
                                    </x-input-label>
                                    <x-text-input id="autenticacao_valor_pago" name="autenticacao_valor_pago" class="w-[200px] h-10 text-sm" required />
                                </div>
                            </div>

                        <!-- Troco -->
                        <div class="campo-formulario flex items-center ml-6"> 
                                <div class="text-left">
                                    <x-input-label for="autenticacao_troco">
                                        Troco:
                                    </x-input-label>
                                    <x-text-input id="autenticacao_troco" name="autenticacao_troco" class="w-[200px] h-10 text-sm" readonly required />
                                </div>
                            </div>
                        
                    </div>
                </div>

            </div> 
    </form>
</x-app-layout>
