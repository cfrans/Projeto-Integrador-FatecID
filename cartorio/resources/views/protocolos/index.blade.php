@php
use Carbon\Carbon;

$dataHoje = Carbon::now()->format('d/m/Y');
$dataPrevisao = Carbon::now()->addDays(10)->format('d/m/Y');
@endphp

<x-app-layout>
    <x-slot name="title">Novo Protocolo</x-slot>

    {{-- Estilo temporario para ajudar a ver as divisoes --}}
    <style>
        .campo-formulario {
            border: 0px;
            padding: 8px;
        }
    </style>
 
    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">
            {{ __('Protocolos') }}
        </h2>
    </x-slot>



    {{-- TODO: Criar o endpoint para o formulario --}}
    <form id="formulario" action="/protocolos" method="post">
        @csrf

        <div class="flex items-center gap-4 -mt-2 w-full mr-14">
    <!-- Conjunto de botões -->
     
    <div class="w-40 h-9 bg-[#9f9f9f] rounded-md flex items-center justify-around px-2 ml-auto">
        <button type="submit" class="w-10 h-10 flex items-center justify-center">
        <img src="{{ asset('images/Salvar.png') }}" alt="Salvar" class="w-4 h-4" />
    </button>

    <button onclick="window.location.href='{{ route('autenticacao.index') }}'" class="w-10 h-10 flex items-center justify-center">
         <img src="{{ asset('images/Dinheiro.png') }}" alt="Dinheiro" class="w-6 h-6" />
    </button>


        <button type="button" class="w-10 h-10 flex items-center justify-center" onclick="limparFormulario()">
            <img src="{{ asset('images/Limpar.png') }}" alt="Limpar" class="w-5 h-5" />
        </button>

    </div>

    <!-- Botão voltar -->
    <div class="w-9 h-9 bg-[#9f9f9f] rounded-full flex items-center justify-around px-2 ml-90 mr-20">
        <button class="w-10 h-10 flex items-center justify-center">
            <img src="{{ asset('images/Voltar.png') }}" alt="Salvar" class="w-4 h-4" />
        </button>
    </div>
</div>

        <x-input-label for="protocolo_grupo" class="ml-20">
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
                        <option value="1">Natureza 01</option>
                        <option value="2">Natureza 02</option>
                        {{-- TODO: Confirmar os tipos de natureza --}}
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

            <!-- Quarta coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="numero_protocolo">
                        Protocolo
                    </x-input-label>
                    <x-text-input id="numero_protocolo" name="numero_protocolo" class="w-[200px] h-8 text-sm" required>
                        {{-- TODO: Confirmar se esse é o numero do protocolo mesmo que vai ser gerado sozinho --}}
                    </x-text-input>
                </div>
            </div>

            <!-- Quinta coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="protocolo_data">
                        Data
                    </x-input-label>
                    <div type="text" id="data_abertura" name="data_abertura" class="w-[150px] h-8 text-sm bg-gray-100 border border-gray-300 rounded px-2 py-1 flex items-center">
                        {{ $dataHoje }}
                    </div>
                </div>
            </div>
        </div>
        <!--parte de cima-->

        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-b-md">

            <!-- Primeira coluna (1/7) -->
            <div class="campo-formulario flex items-center ml-6">
                <div class="text-left">
                    <x-input-label for="numero_documento">
                        Nº Documento / Título
                    </x-input-label>
                    <x-text-input id="numero_documento" name="numero_documento" class="w-[200px] h-8 text-sm" required />
                </div>
            </div>

            <!-- Segunda coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="data_documento">
                        Data do documento
                    </x-input-label>
                    <x-input-date type="date" id="data_documento" name="data_documento" class="w-[150px] h-8 text-sm" required>
                    </x-input-date>
                </div>
            </div>

            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="protocolo_data">
                        Previsão
                    </x-input-label>
                    <div type="text" id="data_abertura" name="data_abertura" class="w-[150px] h-8 text-sm bg-gray-100 border rounded px-2 py-1 flex items-center">
                        {{ $dataPrevisao }}
                    </div>
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
                    <x-input-select id="id_documento" name="id_documento " class="w-[150px] h-8 text-sm" required>
                        <option value="1">RG</option>
                        <option value="2">CPF</option>
                        <option value="3">CNH</option>
                        <option value="4">CNPJ</option>
                    </x-input-select>
                </div>
            </div>


            <!-- Segunda coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="apresentante_numero_documento">
                        Número do Documento
                    </x-input-label>
                    <x-text-input type="text" id="numero_documento" name="numero_documento" class="w-[200px] h-8 text-sm" required>
                    </x-text-input>
                </div>
            </div>

            <!-- Terceira coluna (3/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="apresentante_nome">
                        Nome
                    </x-input-label>
                    <x-text-input type="text" id="nome" name="nome" class="w-[800px] h-8 text-sm" required>
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
                <!-- Mostra o texto fixo "Celular" -->
                <div class="w-[150px] h-8 text-sm bg-gray-100 border border-gray-300 rounded px-2 py-1 flex items-center">
                         Celular
                </div>
                <!-- Input escondido para envio do valor no POST -->
                 <input type="hidden" name="tipo_contato" value="Celular" />
                </div>
            </div>
    

            <!-- Segunda coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="apresentante_numero_contato">
                        Número de Contato
                    </x-input-label>
                    <x-text-input type="text" id="numero_contato" name="numero_contato" class="w-[200px] h-8 text-sm" required>
                    </x-text-input>
                </div>
            </div>

            <!-- Terceira coluna (5/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="apresentante_email">
                        E-mail
                    </x-input-label>
                    <x-text-input type="email" id="email" name="email" class="w-[800px] h-8 text-sm" required>
                    </x-text-input>
                </div>
            </div>
        </div>

        <x-input-label for="protocolo_grupo" class="ml-20 mt-6">
            Dados da Parte
        </x-input-label>

        <div id="container-campos">
            <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-md">

                <!-- Primeira coluna (1/7) -->
                <div class="campo-formulario flex items-center ml-6">
                    <div class="text-left">
                        <x-input-label for="parte_tipo">
                            Tipo
                        </x-input-label>
                        <x-input-select name="id_tipo_parte[]" class="w-[365px] h-8 text-sm" required>
                            <option value="1">Física</option>
                            <option value="2">Jurídica</option>
                        </x-input-select>
                    </div>
                </div>

                <!-- Segunda coluna (3/7) -->
                <div class="campo-formulario flex items-center">
                    <div class="text-left">
                        <x-input-label for="parte_nome">
                            Nome / Razão Social
                        </x-input-label>
                        <x-text-input type="text" name="identificacao[]" class="w-[800px] h-8 text-sm" required>
                        </x-text-input>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botão adicionar -->
        <div class="w-[85%] mx-auto -mt-12 text-right">
            <button type="button" id="parte_adicionar" class="bg-[#9f9f9f] text-black px-3 py-1 rounded hover:bg-blue-600">+</button>
        </div>

        </div>

<script>
    function limparFormulario() {
        document.getElementById('formulario').reset();
    }
</script>


        <script>
            document.getElementById("parte_adicionar").addEventListener("click", function() {
                let container = document.getElementById("container-campos");
                let novaLinha = container.firstElementChild.cloneNode(true); // Clona a primeira linha de campos
                // Limpa os valores e remove os IDs duplicados
                novaLinha.querySelectorAll("input, select").forEach(function (el) {
                    el.value = '';
                    el.removeAttribute('id');
                });
                container.appendChild(novaLinha); // Adiciona ao contêiner
            });
        </script>

    </form>
    {{-- @endsection --}}
</x-app-layout>