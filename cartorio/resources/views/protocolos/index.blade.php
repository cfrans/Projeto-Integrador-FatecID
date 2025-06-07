@php
use Carbon\Carbon;

$dataHoje = Carbon::now()->format('d/m/Y');
$dataPrevisao = Carbon::now()->addDays(10)->format('d/m/Y');
$dataCancelamento = Carbon::now()->addDays(30)->format('d/m/Y');
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

    <div class="max-w-[75%] mx-auto w-full px-4">
        {{-- TODO: Criar o endpoint para o formulario --}}
        <form id="formulario" action="/protocolos" method="post">
            @csrf

            <div class="flex items-center gap-4 -mt-2 w-full mr-14">
                <!-- Conjunto de botões -->

                <div class="w-30 h-10 bg-[#9f9f9f] rounded-md flex items-center justify-around px-2 ml-auto">
                    <button type="submit" class="w-10 h-10 flex items-center justify-center" title="Salvar Protocolo">
                        <img src="{{ asset('images/Salvar.png') }}" alt="Salvar" class="w-4 h-4" />
                    </button>

                    <button type="button" class="w-10 h-10 flex items-center justify-center" onclick="limparFormulario()" title="Limpar">
                        <img src="{{ asset('images/Limpar.png') }}" alt="Limpar" class="w-5 h-5" />
                    </button>

                </div>


                <!-- Botão voltar -->
                <div class="w-9 h-9 bg-[#9f9f9f] rounded-full flex items-center justify-around px-2 ml-90 mr-20 hover:bg-[#8a8a8a]" title="Voltar">
                    <button id="botao-voltar" type="button" class="w-10 h-10 flex items-center justify-center">
                        <img src="{{ asset('images/Voltar.png') }}" alt="Voltar" class="w-4 h-4" />
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
                        <x-input-label for="id_grupo">Grupo</x-input-label>
                        <x-input-select id="id_grupo" name="id_grupo" class="w-[200px] h-7.5 text-sm" required>
                            <option value="1">Títulos e Documentos</option>
                            <option value="2">Pessoa Jurídica</option>
                        </x-input-select>
                    </div>
                </div>

                <div class="campo-formulario flex items-center">
                    <div class="text-left">
                        <x-input-label for="id_natureza">Natureza</x-input-label>
                        <x-input-select id="id_natureza" name="id_natureza" class="w-[400px] h-8 text-sm" required>

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

                <!-- Quarta coluna (1/7) -->
                <div class="campo-formulario flex items-center">
                    <div class="text-left">
                        <x-input-label for="numero_protocolo">
                            Protocolo
                        </x-input-label>
                        <div id="numero_protocolo" class="w-[200px] h-8 text-sm border border-gray-300 rounded px-2 flex items-center bg-gray-100">
                            {{ $protocolo->numero_protocolo ?? '' }}
                        </div>
                        <!-- <x-text-input id="numero_protocolo" name="numero_protocolo" class="w-[200px] h-8 text-sm" required>
                        {{-- TODO: Confirmar se esse é o numero do protocolo mesmo que vai ser gerado sozinho --}}
                    </x-text-input> -->
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
                        <x-text-input id="numero_documento_protocolo" name="numero_documento_protocolo" class="w-[200px] h-8 text-sm" required />
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
                        <div type="text" id="data_cancelamento" name="data_cancelamento" class="w-[150px] h-8 text-sm bg-gray-100 border rounded px-2 py-1 flex items-center">
                            {{ $dataCancelamento }}
                        </div>
                        <!-- <x-input-date type="date" id="data_cancelamento" name="data_cancelamento" class="w-[150px] h-8 text-sm" required /> -->
                    </div>
                </div>
                <!-- TODO: CAMPO NAO EDITAVEL -->

                <!-- Quinta coluna (1/7) -->
                <!-- <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="data_registro">
                        Data de registro
                    </x-input-label>
                    <x-input-date type="date" id="data_registro" name="data_registro" class="w-[150px] h-8 text-sm" required>
                    </x-input-date>
                </div>
            </div> -->

                <!-- Sexta coluna (1/7) -->
                <!-- <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="data_retirada">
                        Data de Retirada
                    </x-input-label>
                    <x-input-date type="date" id="data_retirada" name="data_retirada" class="w-[150px] h-8 text-sm" required>
                    </x-input-date>
                </div>
            </div> -->
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
                        <x-text-input type="text" id="numero_documento_apresentante" name="numero_documento_apresentante" class="w-[250px] h-8 text-sm" required>
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
                        <x-text-input type="text" id="numero_contato" name="numero_contato" class="w-[250px] h-8 text-sm" required>
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
                    {{-- Tipo (filtrado por grupo) --}}
                    <div class="campo-formulario flex items-center ml-6">
                        <div class="text-left">
                            <x-input-label for="tipo_select">Tipo</x-input-label>
                            <x-input-select id="tipo_select" name="id_tipo_parte[]" class="w-[365px] h-8 text-sm" required>
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
                            <x-text-input type="text" name="identificacao[]" class="w-[750px] h-8 text-sm" required>
                            </x-text-input>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Botão adicionar -->
            <div class="w-[85%] mx-auto -mt-12 text-right">
                <button type="button" id="parte_adicionar" class="bg-[#9f9f9f] text-black px-3 py-1 rounded hover:bg-[#8a8a8a]">+</button>
            </div>

    </div>

    <script>
        function limparFormulario() {

            document.getElementById('formulario').reset();
            const container = document.getElementById("container-campos");
            const primeiraLinha = container.firstElementChild;

            // Remove todas as outras linhas
            while (container.children.length > 1) {
                container.removeChild(container.lastElementChild);
            }

            primeiraLinha.querySelectorAll("input, select").forEach(function(el) {
                el.value = '';
            });

            // Atualiza o <select> de tipo com base no grupo atual
            const grupoSelect = document.getElementById('id_grupo');
            const grupoId = grupoSelect.value;

            const tipoSelect = primeiraLinha.querySelector('select[name="id_tipo_parte[]"]');
            if (tipoSelect) {
                // Coleta todas as opções do select original
                const todasOpcoes = Array.from(document.querySelectorAll('#tipo_select option'));
                const filtradas = todasOpcoes.filter(opt => opt.dataset.grupo === grupoId);

                // Limpa e preenche o select com as opções filtradas
                tipoSelect.innerHTML = '';
                filtradas.forEach(opt => tipoSelect.appendChild(opt.cloneNode(true)));

                // Seleciona a primeira automaticamente
                if (filtradas.length > 0) {
                    tipoSelect.value = filtradas[0].value;
                }
            }
        }
    </script>


    <script>
        document.getElementById("parte_adicionar").addEventListener("click", function() {
            const container = document.getElementById("container-campos");
            const novaLinha = container.firstElementChild.cloneNode(true); // Clona a primeira linha
            const grupoSelect = document.getElementById('id_grupo');
            const grupoId = grupoSelect.value;

            // Limpa valores e IDs duplicados
            novaLinha.querySelectorAll("input, select").forEach(function(el) {
                el.value = '';
                el.removeAttribute('id');
            });

            // Atualiza tipos no select clonado
            const tipoSelect = novaLinha.querySelector('select[name="id_tipo_parte[]"]');
            if (tipoSelect) {
                const todasOpcoes = Array.from(document.querySelectorAll('#tipo_select option'));
                const filtradas = todasOpcoes.filter(opt => opt.dataset.grupo === grupoId);
                tipoSelect.innerHTML = '';
                filtradas.forEach(opt => tipoSelect.appendChild(opt.cloneNode(true)));
                // Seleciona o primeiro automaticamente
                if (filtradas.length > 0) {
                    tipoSelect.value = filtradas[0].value;
                }
            }

            container.appendChild(novaLinha); // Adiciona nova parte
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formulario');

            if (!form) {
                console.error('Formulário com id="formulario" não encontrado.');
                return;
            }

            form.addEventListener('submit', async function(e) {
                e.preventDefault(); // Impede envio normal

                // LIMPEZA DE CAMPOS ANTES DO ENVIO
                const numeroDocumentoApresentante = document.getElementById('numero_documento_apresentante');
                const numeroContato = document.getElementById('numero_contato');
                const numeroTitulo = document.getElementById('numero_documento_protocolo');

                if (numeroDocumentoApresentante) {
                    numeroDocumentoApresentante.value = numeroDocumentoApresentante.value.replace(/\D/g, '');
                }
                if (numeroContato) {
                    numeroContato.value = numeroContato.value.replace(/\D/g, '');
                }
                if (numeroTitulo) {
                    numeroTitulo.value = numeroTitulo.value.replace(/\D/g, '');
                }

                console.log('Evento de submit disparado');

                const formData = new FormData(form);

                // Mostrar os dados que estão sendo enviados
                console.log('Dados do formulário:', [...formData.entries()]);

                // DEBUG ////////////////////////////////////
                let debugSaida = '';
                for (const [chave, valor] of formData.entries()) {
                    debugSaida += `${chave}: ${valor}\n`;
                }
                alert('Dados que serão enviados:\n' + debugSaida);
                // DEBUG ////////////////////////////////////


                try {
                    const response = await fetch('/protocolos', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    });

                    console.log('Status da resposta:', response.status);

                    if (response.ok) {
                        console.log('Protocolo salvo com sucesso. Redirecionando...');
                        window.location.href = `/protocolos/ultimo`;
                    } else {
                        let data;
                        try {
                            data = await response.json();
                            console.log('Resposta do erro:', data);
                        } catch {
                            data = {};
                            console.warn('Erro ao converter resposta para JSON');
                        }
                        alert('Erro ao salvar: ' + (data.message || 'Erro desconhecido'));
                    }

                } catch (error) {
                    console.error('Erro na requisição:', error);
                    alert('Erro ao enviar o formulário.');
                }
            });
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const grupoSelect = document.getElementById('id_grupo');
            const naturezaSelect = document.getElementById('id_natureza');
            const todasNaturezas = Array.from(naturezaSelect.options);

            function filtrarNaturezas(grupo) {
                naturezaSelect.innerHTML = '';
                const filtradas = todasNaturezas.filter(opt => opt.dataset.grupo === grupo);
                filtradas.forEach(opt => naturezaSelect.appendChild(opt));
            }

            // Inicializa com o grupo selecionado por padrão 
            filtrarNaturezas(grupoSelect.value);

            // Atualiza quando o grupo mudar
            grupoSelect.addEventListener('change', function() {
                filtrarNaturezas(this.value);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const grupoSelect = document.getElementById('id_grupo');
            const tipoSelect = document.getElementById('tipo_select');
            const todasOpcoes = Array.from(tipoSelect.querySelectorAll('option'));

            function atualizarTipos(grupoId) {
                tipoSelect.innerHTML = '';
                const filtradas = todasOpcoes.filter(opt => opt.dataset.grupo === grupoId);
                filtradas.forEach(opt => tipoSelect.appendChild(opt));
            }

            // Inicializa com o valor atual
            atualizarTipos(grupoSelect.value);

            // Atualiza quando o grupo muda
            grupoSelect.addEventListener('change', function() {
                atualizarTipos(this.value);
            });
        });
    </script>

    </form>
    {{-- @endsection --}}
    </div>
</x-app-layout>