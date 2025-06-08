@vite(['resources/css/app.css', 'resources/js/app.js'])

<x-app-layout>
    <x-slot name="title">Índices</x-slot>
    <div class="max-w-[75%] mx-auto w-full px-4">
        <x-slot name="header">
            <h2 class="font-semibold text-base text-white leading-tight">
                {{ __('Índices') }}
            </h2>
        </x-slot>

        <div class=" min-h-screen">
            <main class="w-full px-8">


                <div class=" p-6 rounded-md">
                    <x-input-label for="pesquisa_protocolo" class="ml-0 mb-0 block text-lg font-semibold">
                        Pesquisa de Protocolo
                    </x-input-label>

                    <div class="bg-white rounded-md">
                        <form action="#" method="GET">
                            <div class="flex flex-wrap gap-4 p-4">
                                <div class="campo-formulario flex flex-col w-[200px]">
                                    <x-input-label for="grupo">Grupo</x-input-label>
                                    <x-input-select id="grupo" name="grupo" class="w-full h-8 text-sm">
                                        <option value="TD">Títulos e Documentos</option>
                                        <option value="PJ">Pessoa Jurídica</option>
                                    </x-input-select>
                                </div>

                                <div class="campo-formulario flex flex-col w-[600px]">
                                    <x-input-label for="natureza">Natureza</x-input-label>
                                    <x-input-select id="id_natureza" name="id_natureza" class="w-full h-8 text-sm">

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

                                <div class="campo-formulario flex flex-col w-[200px]">
                                    <x-input-label for="especie">Espécie</x-input-label>
                                    <x-input-select id="especie" name="especie" class="w-full h-8 text-sm">
                                        <option value="registro">Registro</option>
                                        <option value="averbacao">Averbação</option>
                                    </x-input-select>
                                </div>

                                <div class="campo-formulario flex flex-col w-[200px]">
                                    <x-input-label for="numero_registro">Número do Registro</x-input-label>
                                    <x-text-input id="numero_registro" name="numero_registro" class="w-full h-8 text-sm" />
                                </div>

                                <div class="campo-formulario flex flex-col w-[200px]">
                                    <x-input-label for="documento">Documento</x-input-label>
                                    <x-input-select id="documento" name="documento" class="w-full h-8 text-sm">
                                        <option value="1">RG</option>
                                        <option value="2">CPF</option>
                                        <option value="3">CNH</option>
                                        <option value="4">CNPJ</option>
                                    </x-input-select>
                                </div>

                                <div class="campo-formulario flex flex-col w-[200px]">
                                    <x-input-label for="numero_documento">Número do Documento</x-input-label>
                                    <x-text-input id="numero_documento" name="numero_documento" class="w-full h-8 text-sm" />
                                </div>

                                <div class="campo-formulario flex flex-col w-[675px]">
                                    <x-input-label for="nome">Nome</x-input-label>
                                    <x-text-input id="nome" name="nome" class="w-full h-8 text-sm" />
                                </div>
                                <div class="w-auto h-8 bg-[#9f9f9f] hover:bg-[#8f8f8f] rounded-full flex items-center justify-center mt-[21px] ml-2 px-3">
                                    <button type="button" id="btn-pesquisar-protocolo" class="flex items-center gap-1 text-[#545454] font-semibold text-sm" title="Pesquisar Protocolo">
                                        <img src="{{ asset('images/Pesquisar.png') }}" alt="Pesquisar" class="w-4 h-4" />
                                        Pesquisar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- <div class="p-6 mt-0 rounded-md">
                <x-input-label for="protocolos_encontrados" class="ml-0 mb-0 block text-lg font-semibold">
                    Protocolo(s) Encontrado(s)
                </x-input-label>

                <div class="overflow-x-auto bg-white p-4 rounded-md">
                    <table class="w-full rounded-md">
                        <thead>
                            <tr class="border-b">
                                <th class="px-4 py-2 text-center whitespace-normal break-words">Protocolo</th>
                                <th class="px-4 py-2 text-center whitespace-normal break-words">Grupo</th>
                                <th class="px-4 py-2 text-center whitespace-normal break-words">Natureza</th>
                                <th class="px-4 py-2 text-center whitespace-normal break-words">Data do Protocolo</th>
                                <th class="px-4 py-2 text-center whitespace-normal break-words">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="px-4 py-2 text-center break-words">1</td>
                                <td class="px-4 py-2 text-center break-words">TD</td>
                                <td class="px-4 py-2 text-center break-words">Registro</td>
                                <td class="px-4 py-2 text-center break-words">2025-05-21</td>
                                <td class="px-4 py-2 text-center break-words">
                                    <a href="#">camila</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> -->

                <x-input-label for="protocolos_encontrados" class="ml-6 mb-0 block text-lg font-semibold">
                    Protocolo(s) Encontrado(s)
                </x-input-label>

                <!-- Essa div ficará oculta por padrão -->
                <div id="protocolosEncontrados" class="flex justify-start w-[96.5%] h-[80px] mx-auto bg-white rounded-md andamento-bloco hidden">
                    <div class="campo-formulario flex items-center ml-6">
                        <div class="text-left">
                            <x-input-label for="resultado_protocolo">
                                Protocolo
                            </x-input-label>
                            <x-text-input id="resultado_protocolo" type="text" name="protocolo" class="w-[150px] h-8 text-sm" readonly />
                        </div>
                    </div>

                    <div class="campo-formulario flex items-center ml-6">
                        <div class="text-left">
                            <x-input-label for="resultado_grupo">
                                Grupo
                            </x-input-label>
                            <x-text-input id="resultado_grupo" type="text" name="grupo" class="w-[230px] h-8 text-sm" readonly />
                        </div>
                    </div>

                    <div class="campo-formulario flex items-center ml-6">
                        <div class="text-left">
                            <x-input-label for="resultado_natureza">
                                Natureza
                            </x-input-label>
                            <x-text-input id="resultado_natureza" type="text" name="natureza" class="w-[300px] h-8 text-sm" readonly />
                        </div>
                    </div>

                    <div class="campo-formulario flex items-center ml-6">
                        <div class="text-left">
                            <x-input-label for="resultado_data">
                                Data
                            </x-input-label>
                            <x-text-input id="resultado_data" type="text" name="data" class="w-[130px] h-8 text-sm" readonly />
                        </div>
                    </div>

                    <div class="w-8 h-8 bg-[#9f9f9f] rounded-full flex items-center justify-center ml-auto mr-10 self-center">
                        <button type="button" id="vizualizar" class="w-full h-full flex items-center justify-center rounded-full hover:bg-[#8f8f8f]" title="Visualizar Protocolo">
                            <img src="{{ asset('images/Vizualizar.png') }}" alt="Vizualizar" class="w-4 h-4" />
                        </button>
                    </div>
                </div>



            </main>
        </div>

    </div>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const grupoSelect = document.getElementById('grupo');
        const naturezaSelect = document.getElementById('id_natureza');
        const todasOpcoes = Array.from(naturezaSelect.options);

        // Função para atualizar as naturezas com base no grupo selecionado
        function filtrarNaturezasPorGrupo(grupoSelecionado) {
            // Limpa as opções visíveis
            naturezaSelect.innerHTML = '';

            // Converte o valor do grupo (TD ou PJ) para o número correspondente (1 ou 2)
            const grupoId = grupoSelecionado === 'TD' ? '1' : '2';

            // Filtra e adiciona as opções compatíveis
            todasOpcoes.forEach(opcao => {
                if (opcao.dataset.grupo === grupoId) {
                    naturezaSelect.appendChild(opcao);
                }
            });
        }

        // Evento: quando o grupo for alterado
        grupoSelect.addEventListener('change', function() {
            filtrarNaturezasPorGrupo(grupoSelect.value);
        });

        // Inicializa na carga da página
        filtrarNaturezasPorGrupo(grupoSelect.value);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const btnPesquisar = document.getElementById('btn-pesquisar-protocolo');

    btnPesquisar.addEventListener('click', function(e) {
        e.preventDefault();

        const grupo = document.getElementById('grupo').value;
        const natureza = document.getElementById('id_natureza').value;
        const especie = document.getElementById('especie').value;
        const numeroRegistro = document.getElementById('numero_registro').value;
        const documento = document.getElementById('documento').value;
        const numeroDocumento = document.getElementById('numero_documento').value;
        const nome = document.getElementById('nome').value;

        // Monta a query string com os parâmetros preenchidos
        const params = new URLSearchParams();

        if (grupo) params.append('grupo', grupo);
        if (natureza) params.append('natureza', natureza);
        if (especie) params.append('especie', especie);
        if (numeroRegistro) params.append('numero_registro', numeroRegistro);
        if (documento) params.append('documento', documento);
        if (numeroDocumento) params.append('numero_documento', numeroDocumento);
        if (nome) params.append('nome', nome);

        fetch(`/protocolo/buscar-indices?${params.toString()}`)
            .then(response => {
                if (!response.ok) throw new Error('Nenhum protocolo encontrado.');
                return response.json();
            })
            .then(data => {
                // Preencha os campos da UI com os dados
                document.getElementById('resultado_protocolo').value = data.numero_protocolo ?? '';
                document.getElementById('resultado_grupo').value = data.grupo ?? '';
                document.getElementById('resultado_natureza').value = data.natureza ?? '';
                document.getElementById('resultado_data').value = data.data_documento ?? '';

                document.getElementById('protocolosEncontrados').classList.remove('hidden');
            })
            .catch(error => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Atenção!',
                    text: error.message || 'Nenhum protocolo encontrado.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#c27c5d'
                });
                document.getElementById('protocolosEncontrados').classList.add('hidden');
            });
    });
    });
</script>