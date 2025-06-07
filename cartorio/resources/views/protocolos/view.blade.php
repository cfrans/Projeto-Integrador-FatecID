<x-app-layout>
    <x-slot name="title">Novo Protocolo</x-slot>

    {{-- Estilo para ajudar a ver as divisoes --}}
    <style>
        .campo-formulario {
            border: 0px;
            padding: 8px;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">
            {{ __('Vizualização') }}
        </h2>
    </x-slot>

    <div class="max-w-[75%] mx-auto w-full px-4">
        <div class="flex items-center gap-4 -mt-2 w-full mr-14">
            <!-- Conjunto de botões -->

            <div class="w-70 h-10 bg-[#9f9f9f] rounded-md flex items-center px-2 ml-auto space-x-2">

                <button class="w-8 h-8 flex items-center justify-center" id="btn-retirar-protocolo" title="Retirar Protocolo">
                    <img src="{{ asset('images/Retirar.png') }}" alt="Retirar" class="w-5 h-5" />
                </button>

                <button class="w-8 h-8 flex items-center justify-center" title="Editar Protocolo">
                    <img src="{{ asset('images/Editar.png') }}" alt="Editar" class="w-5 h-5" />
                </button>

                <button class="w-8 h-8 flex items-center justify-center" title="Protocolo Anterior">
                    <img src="{{ asset('images/Voltar.png') }}" alt="Voltar" class="w-5 h-5" />
                </button>

                <button class="w-8 h-8 flex items-center justify-center" title="Protocolo Seguinte">
                    <img src="{{ asset('images/Setadireita.png') }}" alt="Setadireita" class="w-5 h-5" />
                </button>

                <button type="button" onclick="
                    var numero = document.getElementById('numero_protocolo').value;
                    if (numero) {
                        window.location.href = '/autenticacao/' + numero;
                    } else {
                        alert('Digite ou pesquise um número de protocolo antes de autenticar!');
                    }
                " class="w-8 h-8 flex items-center justify-center" title="Autenticar Protocolo">
                    <img src="{{ asset('images/Dinheiro.png') }}" alt="Dinheiro" class="w-5 h-5" />
                </button>

                <button onclick="window.location.href='{{ route('andamento.index') }}'" class="w-8 h-8 flex items-center justify-center" title="Andamento">
                    <img src="{{ asset('images/Andamento.png') }}" alt="Andamento" class="w-5 h-5" />
                </button>


                <button type="button" class="w-8 h-8 flex items-center justify-center" onclick="limparFormulario()" title="Imprimir Protocolo">
                    <img src="{{ asset('images/Imprimir.png') }}" alt="Imprimir" class="w-5 h-5" />
                </button>

            </div>

            <!-- Botão voltar -->
            <div class="w-9 h-9 bg-[#9f9f9f] rounded-full flex items-center justify-around px-2 ml-90 mr-20 hover:bg-[#8a8a8a]">
                <button id="botao-voltar" type="button" class="w-10 h-10 flex items-center justify-center" title="Voltar Protocolo">
                    <img src="{{ asset('images/Voltar.png') }}" alt="Voltar" class="w-4 h-4" />
                </button>
            </div>
        </div>

        <div id="container-campos">
            <div class="flex justify-start w-[31%] h-18 bg-white rounded-md ml-14">


                <!-- Primeira coluna (1/7) -->
                <div class="campo-formulario flex items-center ml-6">
                    <div class="text-left">
                        <x-input-label for="Data">
                            Data
                        </x-input-label>
                        <x-text-input type="text" id="data_abertura" name="data_abertura" class="w-[150px] h-8 text-sm" readonly>
                        </x-text-input>
                    </div>
                </div>

                <!-- Segunda coluna (3/7) -->
                <div class="campo-formulario flex items-center">
                    <div class="text-left">
                        <x-input-label for="Protocolo">
                            Protocolo
                        </x-input-label>
                        <div class="flex items-center gap-2">
                            <x-text-input type="text" id="numero_protocolo" name="numero_protocolo" class="w-[150px] h-8 text-sm" required />
                        </div>
                    </div>
                </div>

                <div class="w-8 h-8 bg-[#9f9f9f] rounded-full flex items-center justify-center mt-[29px] ml-2">
                    <button type="button" id="btn-pesquisar-protocolo" class="w-full h-full flex items-center justify-center rounded-full hover:bg-[#8f8f8f]" title="Pesquisar Protocolo">
                        <img src="{{ asset('images/Pesquisar.png') }}" alt="Pesquisar" class="w-4 h-4" />
                    </button>
                </div>
            </div>
        </div>

        <x-input-label for="protocolo_grupo" class="ml-20 mt-6">
            Dados do Protocolo
        </x-input-label>

        {{-- DIV MENOR PARA O CONTEUDO DOS CAMPOS --}}
        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-t-md">


            <!-- Primeira coluna (2/7) -->
            <div class="campo-formulario flex items-center ml-6">
                <div class="text-left">
                    <x-input-label for="id_grupo">
                        Grupo
                    </x-input-label>
                    <x-input-select id="id_grupo" name="id_grupo" class="w-[200px] h-7.5 text-sm" required>
                        <option value="1">Títulos e Documentos</option>
                        <option value="2">Pessoa Jurídica</option>
                    </x-input-select>
                </div>
            </div>


            <!-- Segunda coluna (2/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="id_natureza">
                        Natureza
                    </x-input-label>
                    <x-input-select id="id_natureza" name="id_natureza " class="w-[400px] h-8 text-sm" required>
                        {{-- Naturezas do Grupo 1 --}}
                        <option value="1" data-grupo="1">Ata de Condomínio</option>
                        <option value="2" data-grupo="1">Cedula de Crédito</option>
                        <option value="3" data-grupo="1">Conservação</option>
                        <option value="4" data-grupo="1">Notificação</option>
                        <option value="5" data-grupo="1">Tradução</option>

                        {{-- Naturezas do Grupo 2 --}}
                        <option value="4" data-grupo="2">Ata de Assembleia</option>
                        <option value="5" data-grupo="2">Abertura de Filial</option>
                        <option value="6" data-grupo="2">Contrato Social</option>
                        <option value="7" data-grupo="2">Distrato</option>
                        <option value="8" data-grupo="2">Estatuto</option>
                    </x-input-select>
                </div>
            </div>

            <!-- Terceira coluna (2/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="id_especie">
                        Espécie
                    </x-input-label>
                    <x-input-select id="id_especie" name="id_especie" class="w-[200px] h-8 text-sm" required>
                        <option value="1">Registro</option>
                        <option value="2">Averbação</option>
                    </x-input-select>
                </div>
            </div>

            <!-- Primeira coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="numero_documento">
                        Nº Documento / Título
                    </x-input-label>
                    <x-text-input id="numero_documento_protocolo" name="numero_documento" class="w-[200px] h-8 text-sm" required readonly />
                </div>
            </div>

            <!-- Segunda coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="data_documento">
                        Data do documento
                    </x-input-label>
                    <x-input-date type="date" id="data_documento_protocolo" name="data_documento" class="w-[150px] h-8 text-sm" required>
                    </x-input-date>
                </div>
            </div>

        </div>
        <!--parte de cima-->

        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-b-md">


            <div class="campo-formulario flex items-center ml-6">
                <div class="text-left">
                    <x-input-label for="protocolo_data">
                        Previsão
                    </x-input-label>
                    <x-input-date type="date" id="previsao" name="previsao" class="w-[150px] h-8 text-sm" />
                </div>
            </div>

            <!-- Quarta coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="data_cancelamento">
                        Cancelamento
                    </x-input-label>
                    <x-input-date type="date" id="data_cancelamento" name="data_cancelamento" class="w-[150px] h-8 text-sm" required />
                </div>
            </div>
            <!-- TODO: CAMPO NAO EDITAVEL -->

            <!-- Quinta coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="data_registro">
                        Data de registro
                    </x-input-label>
                    <x-input-date type="date" id="data_registro" name="data_registro" class="w-[150px] h-8 text-sm" required>
                    </x-input-date>
                </div>
            </div>

            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="registro">
                        Registro
                    </x-input-label>
                    <x-text-input type="text" id="numero_registro" name="numero_registro" class="w-[150px] h-8 text-sm" required>
                    </x-text-input>
                </div>
            </div>

            <!-- Sexta coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="data_retirada">
                        Data de Retirada
                    </x-input-label>
                    <x-input-date type="date" id="data_retirada" name="data_retirada" class="w-[150px] h-8 text-sm" required>
                    </x-input-date>
                </div>
            </div>
        </div>
        <!--acaba aqui-->

        <x-input-label for="protocolo_grupo" class="ml-20 mt-6">
            Dados do Apresentante
        </x-input-label>

        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-t-md">
            <!-- Primeira coluna (1/7) -->
            <div class="campo-formulario flex items-center ml-6">
                <div class="text-left">
                    <x-input-label for="apresentante_documento">
                        Documento
                    </x-input-label>
                    <x-input-select id="id_documento_apresentante" name="id_documento " class="w-[150px] h-8 text-sm" required>
                        <option value="1">RG</option>
                        <option value="2">CPF</option>
                        <option value="3">CNH</option>
                    </x-input-select>
                </div>
            </div>


            <!-- Segunda coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="apresentante_numero_documento">
                        Número do Documento
                    </x-input-label>
                    <x-text-input type="text" id="numero_documento_apresentante" name="numero_documento" class="w-[200px] h-8 text-sm" required readonly>
                    </x-text-input>
                </div>
            </div>

            <!-- Terceira coluna (3/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="apresentante_nome">
                        Nome
                    </x-input-label>
                    <x-text-input type="text" id="nome_apresentante" name="nome" class="w-[800px] h-8 text-sm" required readonly>
                    </x-text-input>
                </div>
            </div>
        </div>

        <!-- segunda parte da tabela de apresentante -->

        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-b-md">
            <!-- Primeira coluna (1/7) -->
            <div class="campo-formulario flex items-center ml-6">
                <div class="text-left">
                    <x-input-label for="apresentante_tipo_contato">
                        Tipo de Contato
                    </x-input-label>
                    <x-text-input type="text" id="tipo_contato_apresentante" name="tipo_contato" class="w-[150px] h-8 text-sm" required readonly>
                    </x-text-input>
                </div>
            </div>
            <!-- TODO: Não vai ser editável, aparecer somente celular -->

            <!-- Segunda coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="apresentante_numero_contato">
                        Número de Contato
                    </x-input-label>
                    <x-text-input type="text" id="numero_contato_apresentante" name="numero_contato" class="w-[200px] h-8 text-sm" required readonly>
                    </x-text-input>
                </div>
            </div>

            <!-- Terceira coluna (5/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="apresentante_email">
                        E-mail
                    </x-input-label>
                    <x-text-input type="email" id="email_apresentante" name="email" class="w-[800px] h-8 text-sm" required readonly>
                    </x-text-input>
                </div>
            </div>
        </div>

        <!-- Bloco de partes -->
        <x-input-label for="protocolo_grupo" class="ml-20 mt-6">
            Dados da Parte
        </x-input-label>
        <div id="container-partes">
            <div class="linha-parte flex justify-start w-[92%] h-20 mx-auto bg-white rounded-md">

                <!-- Primeira coluna (1/7) -->
                <div class="campo-formulario flex items-center ml-6">
                    <div class="text-left">
                        <x-input-label for="parte_tipo">
                            Tipo
                        </x-input-label>
                        <x-input-select name="id_tipo_parte[]" class="w-[365px] h-8 text-sm" required>
                            {{-- Tipos do Grupo 1 --}}
                            <option value="1" data-grupo="1">Condomínio</option>
                            <option value="2" data-grupo="1">Destinatário</option>
                            <option value="3" data-grupo="1">Emitente</option>
                            <option value="4" data-grupo="1">Parte</option>
                            <option value="5" data-grupo="1">Remetente</option>
                            <option value="6" data-grupo="1">Síndico</option>

                            {{-- Tipos do Grupo 2 --}}
                            <option value="7" data-grupo="2">Associação</option>
                            <option value="8" data-grupo="2">Diretor Executivo</option>
                            <option value="9" data-grupo="2">Presidente</option>
                            <option value="10" data-grupo="2">Secretário</option>
                            <option value="11" data-grupo="2">Sócio</option>
                        </x-input-select>
                    </div>
                </div>

                <!-- Segunda coluna (3/7) -->
                <div class="campo-formulario flex items-center">
                    <div class="text-left">
                        <x-input-label for="parte_nome">
                            Nome / Razão Social
                        </x-input-label>
                        <x-text-input type="text" name="identificacao[]" class="w-[800px] h-8 text-sm" required readonly>
                        </x-text-input>
                    </div>
                </div>
            </div>
        </div>


        <div id="container-campos">
            <div class="flex justify-start w-[12%] h-18 bg-white rounded-md mt-6 ml-auto mr-16">

                <!-- Segunda coluna (3/7) -->
                <div class="campo-formulario flex items-center ml-2">
                    <div class="text-left">
                        <x-input-label for="parte_nome">
                            Depósito
                        </x-input-label>
                        <x-text-input type="text" name="identificacao[]" class="w-[130px] h-8 text-sm" required>
                        </x-text-input>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- @endsection --}}
    </div>

</x-app-layout>