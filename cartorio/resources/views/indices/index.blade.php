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
                <div class="p-6 rounded-md">
                    <x-input-label for="pesquisa_protocolo" class="ml-0 mb-0 block text-lg font-semibold">
                        Pesquisa de Protocolo
                    </x-input-label>

                    <div class="bg-white rounded-md">
                        <form action="#" method="GET" id="form-pesquisa-protocolo">
                            <div class="flex flex-wrap gap-4 p-4">

                                <div class="campo-formulario flex flex-col w-[200px]">
                                    <x-input-label for="grupo">Grupo</x-input-label>
                                    <x-input-select id="grupo" name="grupo" class="w-full h-8 text-sm">
                                        <option value="">Todos os Grupos</option>
                                        @foreach ($grupos as $grupo)
                                            <option value="{{ $grupo->id }}">{{ $grupo->tipo }}</option>
                                        @endforeach
                                    </x-input-select>
                                </div>

                                <div class="campo-formulario flex flex-col w-[600px]">
                                    <x-input-label for="id_natureza">Natureza</x-input-label>
                                    <x-input-select id="id_natureza" name="id_natureza" class="w-full h-8 text-sm">
                                        <option value="">Todas as Naturezas</option>
                                        @foreach ($naturezas as $natureza)
                                            <option value="{{ $natureza->id }}" data-grupo="{{ $natureza->id_grupo }}">{{ $natureza->tipo }}</option>
                                        @endforeach
                                    </x-input-select>
                                </div>

                                <div class="campo-formulario flex flex-col w-[200px]">
                                    <x-input-label for="especie">Espécie</x-input-label>
                                    <x-input-select id="especie" name="especie" class="w-full h-8 text-sm">
                                        <option value="">Todas as Espécies</option>
                                        @foreach ($especies as $especie)
                                            <option value="{{ $especie->id }}">{{ $especie->tipo }}</option>
                                        @endforeach
                                    </x-input-select>
                                </div>

                                <div class="campo-formulario flex flex-col w-[200px]">
                                    <x-input-label for="numero_registro">Número do Registro</x-input-label>
                                    <x-text-input id="numero_registro" name="numero_registro" class="w-full h-8 text-sm" />
                                </div>

                                <div class="campo-formulario flex flex-col w-[200px]">
                                    <x-input-label for="documento">Documento</x-input-label>
                                    <x-input-select id="documento" name="documento" class="w-full h-8 text-sm">
                                        <option value="">Todos os Documentos</option>
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

                                <div class="campo-formulario flex flex-col w-[590px]">
                                    <x-input-label for="nome">Nome</x-input-label>
                                    <x-text-input id="nome" name="nome" class="w-full h-8 text-sm" />
                                </div>

                                <div class="flex items-center mt-[21px] ml-2 gap-2">
                                    <div class="w-auto h-8 bg-[#9f9f9f] hover:bg-[#8f8f8f] rounded-full flex items-center justify-center px-3">
                                        <button type="button" id="btn-pesquisar-protocolo" class="flex items-center gap-1 text-[#545454] font-semibold text-sm" title="Pesquisar Protocolo">
                                            <img src="{{ asset('images/Pesquisar.png') }}" alt="Pesquisar" class="w-4 h-4" />
                                            Pesquisar
                                        </button>
                                    </div>
                                    <div class="w-auto h-8 bg-[#9f9f9f] hover:bg-[#8f8f8f] rounded-full flex items-center justify-center px-3">
                                        <button type="button" id="btn-limpar-resultados" class="flex items-center gap-1 text-[#545454] font-semibold text-sm" title="Limpar Filtros e Resultados">
                                            <img src="{{ asset('images/Limpar.png') }}" alt="Limpar" class="w-4 h-4" />
                                            Limpar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="p-6 mt-0 rounded-md" id="area-resultados" style="display: none;">
                    <x-input-label class="ml-0 mb-0 block text-lg font-semibold">
                        Protocolo(s) Encontrado(s)
                    </x-input-label>

                    <div class="overflow-x-auto bg-white p-4 rounded-md mt-2">
                        <table class="w-full rounded-md">
                            <thead>
                                <tr class="border-b">
                                    <th class="px-4 py-2 text-center">Protocolo</th>
                                    <th class="px-4 py-2 text-center">Grupo</th>
                                    <th class="px-4 py-2 text-center">Natureza</th>
                                    <th class="px-4 py-2 text-center">Data</th>
                                    <th class="px-4 py-2 text-center">Visualizar</th>
                                </tr>
                            </thead>
                            <tbody id="tabela-resultados">
                                </tbody>
                        </table>
                    </div>

                    <div id="navegacao-resultados" class="flex items-center justify-between mt-4" style="display: none;">
                        <div id="info-resultados" class="text-sm text-gray-700"></div>
                        <div id="paginacao-resultados" class="flex items-center gap-1"></div>
                    </div>
                </div>

            </main>
        </div>
    </div>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Referências aos Elementos do DOM ---
    const form = document.getElementById('form-pesquisa-protocolo'); 
    const grupoSelect = document.getElementById('grupo');
    const naturezaSelect = document.getElementById('id_natureza');
    const todasOpcoesNatureza = Array.from(naturezaSelect.options);
    const btnPesquisar = document.getElementById('btn-pesquisar-protocolo');
    const tabelaResultados = document.getElementById('tabela-resultados');
    const areaResultados = document.getElementById('area-resultados');
    const btnLimpar = document.getElementById('btn-limpar-resultados');
    const visualizarIconUrl = "{{ asset('images/Vizualizar.png') }}";
    const infoResultadosEl = document.getElementById('info-resultados');
    const paginacaoResultadosEl = document.getElementById('paginacao-resultados');
    const navegacaoResultadosEl = document.getElementById('navegacao-resultados');

    // --- Lógica de Filtro Dinâmico de Natureza ---
    function filtrarNaturezasPorGrupo(grupoIdSelecionado) {
        naturezaSelect.innerHTML = '';
        const opcaoTodas = todasOpcoesNatureza.find(opt => opt.value === '');
        if (opcaoTodas) naturezaSelect.appendChild(opcaoTodas.cloneNode(true));
        
        todasOpcoesNatureza.forEach(opcao => {
            if (opcao.value === "") return;
            if (!grupoIdSelecionado || opcao.dataset.grupo == grupoIdSelecionado) {
                naturezaSelect.appendChild(opcao.cloneNode(true));
            }
        });
    }

    // --- Lógica Principal da Busca ---
    function executarBusca(page = 1) {
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);
        params.append('page', page);

        tabelaResultados.innerHTML = '<tr><td colspan="5" class="text-center py-4">Buscando...</td></tr>';
        areaResultados.style.display = 'block';
        navegacaoResultadosEl.style.display = 'none';

        fetch(`/protocolo/buscar-indices?${params.toString()}`)
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw new Error(err.erro || 'Nenhum protocolo encontrado.'); });
                }
                return response.json();
            })
            .then(paginatedData => {
                tabelaResultados.innerHTML = '';
                const protocolos = paginatedData.data;

                if (protocolos.length === 0) {
                    tabelaResultados.innerHTML = '<tr><td colspan="5" class="text-center py-4">Nenhum protocolo corresponde aos critérios.</td></tr>';
                    infoResultadosEl.innerHTML = '';
                    paginacaoResultadosEl.innerHTML = '';
                    return;
                }

                protocolos.forEach(protocolo => {
                    const row = document.createElement('tr');
                    row.classList.add('border-b');
                    const dataFormatada = new Date(protocolo.created_at).toLocaleDateString('pt-BR', { timeZone: 'UTC' });
                    
                    row.innerHTML = `
                        <td class="px-4 py-2 text-center">
                            <a href="/protocolos/view/${protocolo.numero_protocolo}" class="text-[#C27C5D] hover:text-[#A86A4F] font-bold" title="Abrir protocolo ${protocolo.numero_protocolo}">${protocolo.numero_protocolo}</a>
                        </td>
                        <td class="px-4 py-2 text-center">${protocolo.grupo}</td>
                        <td class="px-4 py-2 text-center">${protocolo.natureza}</td>
                        <td class="px-4 py-2 text-center">${dataFormatada}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="/protocolos/view/${protocolo.numero_protocolo}" class="inline-block" title="Visualizar protocolo ${protocolo.numero_protocolo}"><img src="${visualizarIconUrl}" alt="Visualizar" class="w-5 h-5" /></a>
                        </td>
                    `;
                    tabelaResultados.appendChild(row);
                });

                infoResultadosEl.innerText = `Mostrando de ${paginatedData.from} a ${paginatedData.to} de ${paginatedData.total} resultados.`;
                renderizarPaginacao(paginatedData.links);
                navegacaoResultadosEl.style.display = 'flex';
            })
            .catch(error => {
                tabelaResultados.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-red-500">${error.message}</td></tr>`;
                infoResultadosEl.innerHTML = '';
                paginacaoResultadosEl.innerHTML = '';
            });
    }

    // --- Lógica da Paginação ---
    function renderizarPaginacao(links) {
        paginacaoResultadosEl.innerHTML = '';
        links.forEach(link => {
            if (!link.url) {
                const button = document.createElement('button');
                button.innerHTML = link.label.replace('&laquo;', '«').replace('&raquo;', '»');
                button.className = 'px-3 py-1 text-sm rounded-md border text-gray-400 cursor-not-allowed';
                button.disabled = true;
                paginacaoResultadosEl.appendChild(button);
                return;
            }

            const pageNumber = new URL(link.url).searchParams.get('page');
            const button = document.createElement('button');
            button.innerHTML = link.label.replace('&laquo;', '«').replace('&raquo;', '»');
            button.className = 'px-3 py-1 text-sm rounded-md border bg-white text-gray-700 hover:bg-gray-50';

            if (link.active) {
                button.className = 'px-3 py-1 text-sm rounded-md border bg-[#C27C5D] text-white border-[#C27C5D]';
                button.disabled = true;
            } else {
                button.onclick = () => executarBusca(pageNumber);
            }
            paginacaoResultadosEl.appendChild(button);
        });
    }

    // --- Event Listeners ---
    grupoSelect.addEventListener('change', function() { filtrarNaturezasPorGrupo(this.value); });
    btnPesquisar.addEventListener('click', function(e) {
        e.preventDefault();
        executarBusca(1);
    });
    btnLimpar.addEventListener('click', function() {
        form.reset();
        areaResultados.style.display = 'none';
        navegacaoResultadosEl.style.display = 'none';
        tabelaResultados.innerHTML = '';
        infoResultadosEl.innerHTML = '';
        paginacaoResultadosEl.innerHTML = '';
        filtrarNaturezasPorGrupo(grupoSelect.value);
    });
    // Inicializa o filtro dinâmico ao carregar a página
    filtrarNaturezasPorGrupo(grupoSelect.value);
});
</script>

