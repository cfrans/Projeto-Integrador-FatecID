<x-app-layout>
    <!-- Slot de título da aba do navegador -->
    <x-slot name="title">Autenticação</x-slot>

    <style>
        .campo-formulario {
            border: 0px;
            padding: 8px;
        }

        input:disabled,
        select:disabled,
        textarea:disabled {
            background-color: #e4e6eb;
        }
    </style>

    <!-- Slot de cabeçalho visual da página -->
    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">
            {{ __('Autenticação') }}
        </h2>
    </x-slot>

    <form action="{{ route('autenticacao.store') }}" method="post">
        @csrf
        {{-- DIV MENOR PARA O CONTEUDO DOS CAMPOS --}}
        <div class="flex justify-center items-start min-h-screen py-10 gap-5 bg-gray-100">

            <div class="flex flex-col gap-1 bg-white shadow-md rounded-md mt-8 p-6 w-fit">
                <div class="flex flex-wrap justify-start w-full">
                    <!-- Primeira coluna (1/8) -->

                    <div class="campo-formulario flex items-center ml-3">
                        <div class="text-left">
                            <x-input-label for="autenticacao_data">
                                Data
                            </x-input-label>
                            @php
                                $now = $now ?? \Carbon\Carbon::now();
                            @endphp
                            <x-input-naoalteravel id="data_autenticacao" name="data_autenticacao" class="w-[200px] h-10 text-sm" value="{{ $now->format('d/m/Y') }}" readonly />

                        </div>
                    </div>

                    <!-- Segunda coluna (2/8) -->
                    <div class="campo-formulario flex items-center ml-6">
                        <div class="text-left">
                            <x-input-label for="autenticacao_hora">
                                Hora
                            </x-input-label>
                            <x-input-naoalteravel id="autenticacao_hora" name="autenticacao_hora" class="w-[200px] h-9 text-sm">
                            </x-input-naoalteravel>
                        </div>
                    </div>

                    <!-- Terceira coluna (3/8) -->
                    <div class="campo-formulario flex items-center ml-6">
                        <div class="text-left">
                            <x-input-label for="autenticacao_usuario">
                                Usuário
                            </x-input-label>
                            <x-input-naoalteravel id="nome" name="nome" class="w-[200px] h-9 text-sm" value="{{ Auth::user() ? Auth::user()->nome : '' }}" readonly />
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap justify-start w-full">
                    <!-- Quarta coluna (4/8) -->
                    <div class="campo-formulario flex items-center ml-3">
                        <div class="text-left">
                            <x-input-label for="autenticacao_grupo">
                                Grupo
                            </x-input-label>
                            <x-input-naoalteravel id="protocolo_grupo" name="protocolo_grupo" value="{{ $protocolo->grupo->tipo ?? '' }}" class="w-[435px] h-10 text-sm">
                            </x-input-naoalteravel>
                        </div>
                    </div>

                    <!-- Quinta coluna (5/8) -->
                    <div class="campo-formulario flex items-center ml-6">
                        <div class="text-left">
                            <x-input-label for="autenticacao_protocolo">
                                Protocolo
                            </x-input-label>
                            <x-input-naoalteravel id="id_protocolo" name="id_protocolo" value="{{ $protocolo->numero_protocolo ?? '' }}" class="w-[200px] h-10 text-sm">
                            </x-input-naoalteravel>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap justify-start w-full">
                    <!-- Quinta coluna (5/8) -->
                    <div class="campo-formulario flex items-center ml-3">
                        <div class="text-left">
                            <x-input-label for="autenticacao_apresentante">
                                Apresentante
                            </x-input-label>
                            <x-input-naoalteravel id="apresentante_nome" name="apresentante_nome" value="{{ $protocolo->apresentante->nome ?? '' }}" class="w-[435px] h-10 text-sm">
                            </x-input-naoalteravel>
                        </div>
                    </div>

                    <!-- Sexta coluna (6/8) -->
                    <div class="campo-formulario flex items-center ml-6">
                        <div class="text-left">
                            <x-input-label for="autenticacao_valor">
                                Valor
                            </x-input-label>
                            <x-input-number type="number" step="0.01" id="valor" name="valor" class="w-[200px] h-9 text-sm" required>
                            </x-input-number>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap justify-start w-full">
                    <!-- Sétima coluna (7/8) -->
                    <div class="campo-formulario flex items-center ml-3">
                        <div class="text-left">
                            <x-input-label for="autenticacao_pagamento">
                                Forma de Pagamento
                            </x-input-label>
                            <x-input-select id="id_forma_pagamento" name="id_forma_pagamento" class="w-[340px] h-9 text-sm" required>
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
                            <x-input-label for="banco">
                                Banco
                            </x-input-label>
                            <x-input-select id="banco" name="banco" class="w-[300px] h-9 text-sm" required disabled>
                                <option value="Caixa Econômica">Caixa Econômica</option>
                                <option value="Banco do Brasil">Banco do Brasil</option>
                                <option value="Itaú">Itaú</option>
                                <option value="Bradesco">Bradesco </option>
                                <option value="Santander">Santander</option>
                            </x-input-select>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap justify-start w-full">
                    <!-- Primeira coluna (1/3) -->
                    <!--<div id="cheque"> -->
                    <div class="campo-formulario flex items-center ml-3">
                        <div class="text-left">
                            <x-input-label for="conta">
                                Conta
                            </x-input-label>
                            <x-text-input id="conta" name="conta" class="w-[200px] h-9 text-sm" required disabled />
                        </div>
                    </div>

                    <!-- Segunda coluna (1/3) -->
                    <div class="campo-formulario flex items-center ml-6">
                        <div class="text-left">
                            <x-input-label for="agencia">
                                Agência
                            </x-input-label>
                            <x-text-input id="agencia" name="agencia" class="w-[200px] h-9 text-sm" required disabled />
                        </div>
                    </div>

                    <!-- Terceira coluna (3/3) -->
                    <div class="campo-formulario flex items-center ml-6">
                        <div class="text-left">
                            <x-input-label for="numero_cheque">
                                Número do cheque
                            </x-input-label>
                            <x-text-input id="numero_cheque" name="numero_cheque" class="w-[200px] h-9 text-sm" required disabled />
                        </div>
                    </div>
                    <!--</div>-->
                </div>
            </div>
            <div class="flex flex-col gap-4 mt-8">
                <!-- DIV com os pagamentos -->
                <div class="flex flex-col gap-1 bg-white shadow-md rounded-md p-6 w-fit">
                    <div class="flex flex-col justify-start w-full gap-4">

                        <!-- Valor Prévio -->
                        <div class="campo-formulario flex items-center mx-auto">
                            <div class="text-left">
                                <x-input-label for="autenticacao_valor_previo">
                                    Valor Prévio:
                                </x-input-label>
                                <x-input-number type="number" step="0.01" id="autenticacao_valor_previo" name="autenticacao_valor_previo" class="w-[300px] h-9 text-sm" readonly required />
                            </div>
                        </div>

                        <!-- Valor Pago -->
                        <div class="campo-formulario flex items-center mx-auto">
                            <div class="text-left">
                                <x-input-label for="autenticacao_valor_pago">
                                    Valor Pago:
                                </x-input-label>
                                <x-input-number type="number" step="0.01" id="autenticacao_valor_pago" name="autenticacao_valor_pago" class="w-[300px] h-9 text-sm" required />
                            </div>
                        </div>

                        <!-- Troco -->
                        <div class="campo-formulario flex items-center mx-auto">
                            <div class="text-left">
                                <x-input-label for="autenticacao_troco">
                                    Troco:
                                </x-input-label>
                                <x-input-number type="number" step="0.01" id="autenticacao_troco" name="autenticacao_troco" class="w-[300px] h-9 text-sm" readonly required />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Botões de ação -->
                <div class="w-500 h-10 bg-[#9f9f9f] rounded-md flex items-center justify-around px-2">

                    <button type="submit" class="flex items-center justify-center gap-2 px-3 py-2">
                        <img src="{{ asset('images/Salvar.png') }}" alt="Salvar" class="w-4 h-4" />
                        <span class="text-sm font-bold text-[#474747]">Salvar</span>
                    </button>


                    <button id="btn-voltar-protocolo" type="button" class="flex items-center justify-center gap-2 px-3 py-2">
                        <img src="{{ asset('images/Voltar.png') }}" alt="Voltar" class="w-4 h-4" />
                        <span class="text-sm font-bold text-[#474747]">Voltar</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const horaInput = document.getElementById('autenticacao_hora');
        if (horaInput) {
            const now = new Date();
            // Formatar para HH:mm:ss
            const horaFormatada = now.toLocaleTimeString('pt-BR', {
                hour12: false
            });
            horaInput.value = horaFormatada;
        }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const campoValor = document.getElementById('valor');
        const campoValorPrevio = document.getElementById('autenticacao_valor_previo');
        const campoValorPago = document.getElementById('autenticacao_valor_pago');
        const campoTroco = document.getElementById('autenticacao_troco');

        // Atualiza "Valor Prévio" com o valor do campo "Valor"
        if (campoValor) {
            campoValor.addEventListener('input', function() {
                campoValorPrevio.value = campoValor.value;
                calcularTroco();
            });
        }

        // Atualiza "Troco" com base em "Valor Pago" e "Valor Prévio"
        campoValorPago.addEventListener('input', calcularTroco);

        function calcularTroco() {
            const valorPrevio = parseFloat(campoValorPrevio.value.replace(',', '.')) || 0;
            const valorPago = parseFloat(campoValorPago.value.replace(',', '.')) || 0;
            const troco = valorPago - valorPrevio;
            campoTroco.value = troco.toFixed(2).replace('.', ',');
        }

        // Botão de voltar
        document.getElementById('btn-voltar-protocolo').addEventListener('click', function() {
            window.location.href = "{{ route('protocolos.view') }}";
        });

        // Liberação dos campos de cheque
        const formaPagamento = document.getElementById('id_forma_pagamento');
        const camposCheque = [
            document.getElementById('banco'),
            document.getElementById('conta'),
            document.getElementById('agencia'),
            document.getElementById('numero_cheque')
        ];

        function liberaCamposCheque() {
            const isCheque = formaPagamento.value === '4'; //Cheque
            camposCheque.forEach(campo => {
                campo.disabled = !isCheque;
            });
        }

        // Roda qnd carrega e ao trocar a forma de pagamento
        liberaCamposCheque();
        formaPagamento.addEventListener('change', liberaCamposCheque);
    });
</script>