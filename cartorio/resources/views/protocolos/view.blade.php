<x-app-layout>
    <x-slot name="title">Visualizar Protocolo</x-slot>

    <style>
        .campo-formulario{border:0;padding:8px}@media print{@page{size:A4 landscape;margin:5mm}body{zoom:80%}#conteudo{max-width:100%!important;width:100%!important;padding:0!important}.no-print{display:none!important}}
    </style>

    <x-slot name="header" class="no-print">
        <h2 class="no-print font-semibold text-base text-white leading-tight">
            {{ __('Visualização') }}
        </h2>
    </x-slot>


    <div class="max-w-[75%] mx-auto w-full px-4" id="conteudo">
        <div class="flex items-center gap-4 -mt-2 w-full mr-14">
            <div class="w-70 h-10 bg-[#9f9f9f] rounded-md flex items-center px-2 ml-auto space-x-2">
               
                <button type="button" class="w-8 h-8 flex items-center justify-center no-print acao-protocolo" title="Editar Protocolo" id="btn-editar-protocolo">
                    <img src="{{ asset('images/Editar.png') }}" alt="Editar" class="w-5 h-5 no-print" />
                </button>
                <button type="button" id="btn-protocolo-anterior" class="w-8 h-8 flex items-center justify-center no-print" title="Protocolo Anterior">
                    <img src="{{ asset('images/Voltar.png') }}" alt="Setaesquerda" class="w-5 h-5 no-print" />
                </button>
                <button type="button" id="btn-protocolo-seguinte" class="w-8 h-8 flex items-center justify-center no-print" title="Protocolo Seguinte">
                    <img src="{{ asset('images/Setadireita.png') }}" alt="Setadireita" class="w-5 h-5 no-print" />
                </button>
                </button>
                <button type="button" onclick="redirecionarParaAutenticacao()" class="w-8 h-8 flex items-center justify-center no-print acao-protocolo" title="Autenticar Protocolo">
                    <img src="{{ asset('images/Dinheiro.png') }}" alt="Dinheiro" class="w-5 h-5" />
                </button>
                <button type="button" id="btn-retirar-protocolo" class="w-8 h-8 flex items-center justify-center no-print acao-protocolo" title="Retirar Protocolo">
                    <img src="{{ asset('images/Retirar.png') }}" alt="Retirar" class="w-5 h-5 no-print" />
                </button>
                <button type="button" id="btn-cancelar-protocolo" class="w-8 h-8 flex items-center justify-center no-print acao-protocolo" title="Cancelar Protocolo">
                    <img src="{{ asset('images/Cancelar.png') }}" alt="Cancelar" class="w-5 h-5" />
                </button>
                <button type="button" class="w-8 h-8 flex items-center justify-center no-print" onclick="window.print()" title="Imprimir Protocolo">
                    <img src="{{ asset('images/Imprimir.png') }}" alt="Imprimir" class="w-5 h-5" />
                </button>
            </div>
            <div class="w-9 h-9 bg-[#9f9f9f] rounded-full flex items-center justify-around px-2 ml-90 mr-20 hover:bg-[#8a8a8a]">
                <button id="botao-voltar" type="button" class="w-10 h-10 flex items-center justify-center" title="Voltar Protocolo">
                    <img src="{{ asset('images/Voltar.png') }}" alt="Voltar" class="w-4 h-4" />
                </button>
            </div>
        </div>

        <div id="container-campos">
            <div class="flex justify-start w-[31%] h-18 bg-white rounded-md ml-14">
                <div class="campo-formulario flex items-center ml-6">
                    <div class="text-left">
                        <x-input-label for="data_abertura">Data</x-input-label>
                        <x-text-input type="text" id="data_abertura" name="data_abertura" class="w-[150px] h-8 text-sm" readonly></x-text-input>
                    </div>
                </div>
                <div class="campo-formulario flex items-center">
                    <div class="text-left">
                        <x-input-label for="numero_protocolo">Protocolo</x-input-label>
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

        <x-input-label for="protocolo_grupo" class="ml-20 mt-6">Dados do Protocolo</x-input-label>

        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-t-md">
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
                    <x-input-select id="id_natureza" name="id_natureza " class="w-[400px] h-8 text-sm" required>
                        <option value="1" data-grupo="1">Ata de Condomínio</option>
                        <option value="2" data-grupo="1">Cedula de Crédito</option>
                        <option value="3" data-grupo="1">Conservação</option>
                        <option value="4" data-grupo="1">Notificação</option>
                        <option value="5" data-grupo="1">Tradução</option>
                        <option value="4" data-grupo="2">Ata de Assembleia</option>
                        <option value="5" data-grupo="2">Abertura de Filial</option>
                        <option value="6" data-grupo="2">Contrato Social</option>
                        <option value="7" data-grupo="2">Distrato</option>
                        <option value="8" data-grupo="2">Estatuto</option>
                    </x-input-select>
                </div>
            </div>
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="id_especie">Espécie</x-input-label>
                    <x-input-select id="id_especie" name="id_especie" class="w-[200px] h-8 text-sm" required>
                        <option value="1">Registro</option>
                        <option value="2">Averbação</option>
                    </x-input-select>
                </div>
            </div>
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="numero_documento">Nº Documento / Título</x-input-label>
                    <x-text-input id="numero_documento_protocolo" name="numero_documento" class="w-[200px] h-8 text-sm" required readonly/>
                </div>
            </div>
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="data_documento">Data do documento</x-input-label>
                    <x-input-date type="date" id="data_documento_protocolo" name="data_documento" class="w-[150px] h-8 text-sm" required></x-input-date>
                </div>
            </div>
        </div>

        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-b-md">
            <div class="campo-formulario flex items-center ml-6">
                <div class="text-left">
                    <x-input-label for="previsao">Previsão</x-input-label>
                    <x-input-date type="date" id="previsao" name="previsao" class="w-[150px] h-8 text-sm" />
                </div>
            </div>
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="data_cancelamento">Cancelamento</x-input-label>
                    <x-input-date type="date" id="data_cancelamento" name="data_cancelamento" class="w-[150px] h-8 text-sm" required />
                </div>
            </div>
             <div class="campo-formulario flex items-center">
                    <div class="text-left">
                        <x-input-label for="registro">
                            Registro
                        </x-input-label>
                        <x-text-input type="text" id="numero_registro" name="numero_registro" class="w-[150px] h-8 text-sm"
        value="{{ $protocolo->numero_registro ?? '' }}" readonly />
                    </div>
                </div>

            <!-- Sexta coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="data_registro">
                        Data de Registro
                    </x-input-label>
                   <x-input-date 
                    id="data_registro" 
                    name="data_registro" 
                    class="w-[150px] h-8 text-sm"
                    :value="isset($protocolo) ? \Carbon\Carbon::parse($protocolo->data_registro)->format('Y-m-d') : ''" 
                    readonly>
                </x-input-date>
                </div>
            </div>
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="data_retirada">Data de Retirada</x-input-label>
                    <x-input-date type="date" id="data_retirada" name="data_retirada" class="w-[150px] h-8 text-sm" required></x-input-date>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between w-[92%] mx-auto mt-6 mb-2">
            <x-input-label for="apresentante_grupo" class="ml-5">
                Dados do Apresentante
            </x-input-label>
            <div class="flex items-center">
                <button type="button" id="btn-salvar-edicao-apresentante"
                    class="hidden ml-0 w-8 h-8 flex items-center justify-center hover:bg-[#8f8f8f]">
                    <img src="{{ asset('images/Salvar.png') }}" alt="Salvar" class="w-5 h-5 no-print" />
                </button>
                <button type="button" id="btn-cancelar-edicao-apresentante"
                    class="hidden ml-0 w-8 h-8 flex items-center justify-center hover:bg-[#8f8f8f]">
                    <img src="{{ asset('images/Cancelar.png') }}" alt="Cancelar" class="w-5 h-5 no-print" />
                </button>
            </div>
        </div>

        <div id="apresentante_grupo">
        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-t-md">
            <div class="campo-formulario flex items-center ml-6">
                <div class="text-left">
                    <x-input-label for="id_documento_apresentante">Documento</x-input-label>
                    <x-input-select id="id_documento_apresentante" name="id_documento" class="w-[150px] h-8 text-sm" required disabled>
                        <option value="1">RG</option>
                        <option value="2">CPF</option>
                        <option value="3">CNH</option>
                        <option value="4">CNPJ</option>
                    </x-input-select>
                </div>
            </div>
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="numero_documento_apresentante">Número do Documento</x-input-label>
                    <x-text-input type="text" id="numero_documento_apresentante" name="numero_documento" class="w-[200px] h-8 text-sm" required readonly></x-text-input>
                </div>
            </div>
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="nome_apresentante">Nome</x-input-label>
                    <x-text-input type="text" id="nome_apresentante" name="nome" class="w-[800px] h-8 text-sm" required readonly></x-text-input>
                </div>
            </div>
        </div>

        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-b-md">
            <div class="campo-formulario flex items-center ml-6">
                <div class="text-left">
                    <x-input-label for="tipo_contato_apresentante">Tipo de Contato</x-input-label>
                    <x-text-input type="text" id="tipo_contato_apresentante" name="tipo_contato" class="w-[150px] h-8 text-sm" required readonly></x-text-input>
                </div>
            </div>
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="numero_contato_apresentante">Número de Contato</x-input-label>
                    <x-text-input type="text" id="numero_contato_apresentante" name="numero_contato" class="w-[200px] h-8 text-sm" required readonly></x-text-input>
                </div>
            </div>
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="email_apresentante">E-mail</x-input-label>
                    <x-text-input type="email" id="email_apresentante" name="email" class="w-[800px] h-8 text-sm" required readonly></x-text-input>
                </div>
            </div>
        </div>
        </div>

        
        <x-input-label for="parte_grupo" class="ml-20 mt-6">Dados da Parte</x-input-label>
        <div id="container-partes">
            <div class="linha-parte flex justify-start w-[92%] h-20 mx-auto bg-white rounded-md">
                <div class="campo-formulario flex items-center ml-6">
                    <div class="text-left">
                        <x-input-label for="parte_tipo">Tipo</x-input-label>
                        <x-input-select name="id_tipo_parte[]" class="w-[365px] h-8 text-sm" required>
                            <option value="1" data-grupo="1">Condomínio</option>
                            <option value="2" data-grupo="1">Destinatário</option>
                            <option value="3" data-grupo="1">Emitente</option>
                            <option value="4" data-grupo="1">Parte</option>
                            <option value="5" data-grupo="1">Remetente</option>
                            <option value="6" data-grupo="1">Síndico</option>
                            <option value="7" data-grupo="2">Associação</option>
                            <option value="8" data-grupo="2">Diretor Executivo</option>
                            <option value="9" data-grupo="2">Presidente</option>
                            <option value="10" data-grupo="2">Secretário</option>
                            <option value="11" data-grupo="2">Sócio</option>
                        </x-input-select>
                    </div>
                </div>
                <div class="campo-formulario flex items-center">
                    <div class="text-left">
                        <x-input-label for="parte_nome">Nome / Razão Social</x-input-label>
                        <x-text-input type="text" name="identificacao[]" class="w-[800px] h-8 text-sm" required readonly></x-text-input>
                    </div>
                </div>
            </div>
        </div>


<div id="container-campos">
    <div class="flex justify-start w-[12%] h-19 bg-white rounded-md mt-6 ml-auto mr-16 mb-10">
        <div class="campo-formulario flex items-center ml-2">
            <div class="text-left">
                <x-input-label for="deposito">Depósito</x-input-label>
                <x-text-input
                    type="text"
                    id="deposito"
                    name="deposito"
                    class="w-[130px] h-8 text-sm"
                    value="{{ number_format($deposito ?? 0, 2, ',', '.') }}"
                    readonly
                />
            </div>
        </div>
    </div>
</div>

<div id="mensagem-cancelado" style="display:none;" class="ml-14 w-[92%] bg-red-200 text-red-800 px-4 py-2 rounded mb-4 font-bold">
    Este protocolo está cancelado. Nenhuma ação pode ser realizada.
</div>
<input type ="hidden" id="protocolo_id" value="{{ $protocolo->id?? '' }}">
<input type ="hidden" id="apresentante_id" value="{{ $apresentante->id ?? '' }}">
</div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Torna campos de data e selects somente leitura
        document.querySelectorAll('input[type="date"]').forEach(input => input.readOnly = true);
        document.querySelectorAll('select').forEach(select => {
            select.style.pointerEvents = 'none';
            select.tabIndex = -1;
            select.addEventListener('mousedown', e => e.preventDefault());
        });

        // Preenche protocolo se $ultimo_numero existir e pesquisa
        @if(!empty($ultimo_numero))
            document.getElementById('numero_protocolo').value = "{{ $ultimo_numero }}";
            document.getElementById('btn-pesquisar-protocolo').click();
        @endif
    });

    // Função para preencher campos por id
    const setValueById = (id, value) => {
        const el = document.getElementById(id);
        if (el) el.value = value || '';
    };

    // Função para preencher selects por id
    const setSelectById = (id, value) => {
        const el = document.getElementById(id);
        if (el) el.value = value || '';
    };

    // Calcula data de previsão
    const calcularPrevisao = (dataAbertura) => {
        if (!dataAbertura) return '';
        const data = new Date(dataAbertura);
        data.setDate(data.getDate() + 10);
        return data.toISOString().slice(0, 10);
    };

    // Formata data para input type=date
    const formatDateToInput = (dateString) => {
        if (!dateString) return '';
        const date = new Date(dateString);
        return isNaN(date) ? '' : date.toISOString().slice(0, 10);
    };

    // Aplica máscaras de visualização
    const aplicarMascarasDeVisualizacao = () => {
        const doc = document.getElementById('numero_documento_apresentante');
        const tipo = document.getElementById('id_documento_apresentante');
        const contato = document.getElementById('numero_contato_apresentante');

        if (contato?.value) {
            let raw = contato.value.replace(/\D/g, '');
            contato.value = raw.length > 6 ? `(${raw.slice(0, 2)}) ${raw.slice(2, 7)}-${raw.slice(7)}` :
                            raw.length > 2 ? `(${raw.slice(0, 2)}) ${raw.slice(2)}` :
                            `(${raw}`;
        }

        if (doc?.value && tipo?.value) {
            let valor = doc.value.replace(/\D/g, '');
            switch (tipo.value) {
                case '1': // RG
                    valor = valor.slice(0, 9);
                    doc.value = valor.length > 7 ? `${valor.slice(0, 2)}.${valor.slice(2, 5)}.${valor.slice(5, 8)}-${valor.slice(8)}` :
                                valor.length > 4 ? `${valor.slice(0, 2)}.${valor.slice(2, 5)}.${valor.slice(5)}` :
                                valor.length > 2 ? `${valor.slice(0, 2)}.${valor.slice(2)}` : valor;
                    break;
                case '2': // CPF
                    valor = valor.slice(0, 11);
                    doc.value = valor.length > 9 ? `${valor.slice(0, 3)}.${valor.slice(3, 6)}.${valor.slice(6, 9)}-${valor.slice(9)}` :
                                valor.length > 6 ? `${valor.slice(0, 3)}.${valor.slice(3, 6)}.${valor.slice(6)}` :
                                valor.length > 3 ? `${valor.slice(0, 3)}.${valor.slice(3)}` : valor;
                    break;
                case '3': // CNH
                    doc.value = valor.slice(0, 11);
                    break;
            }
        }
    };

    // Redireciona para autenticação
    const redirecionarParaAutenticacao = () => {
        const numero = document.getElementById('numero_protocolo').value;
        if (numero) {
            window.location.href = `/autenticacao/${numero}`;
        } else {
            alert('Digite ou pesquise um número de protocolo antes de autenticar!');
        }
    };

        // Funções para exibir/ocultar mensagem de cancelamento e bloquear/desbloquear ações
    function exibirMensagemCancelado() {
        document.getElementById('mensagem-cancelado').style.display = 'block';
    }
    function removerMensagemCancelado() {
        document.getElementById('mensagem-cancelado').style.display = 'none';
    }
    function bloquearAcoesProtocolo() {
        // Desabilite botões conforme necessário
        document.querySelectorAll('.acao-protocolo').forEach(btn => {
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');
        });
    }
    function desbloquearAcoesProtocolo() {
        document.querySelectorAll('.acao-protocolo').forEach(btn => {
            btn.disabled = false;
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
        });
    }

    function atualizarBotaoCancelar() {
        const dataRegistro = document.getElementById('data_registro')?.value;
        const dataRetirada = document.getElementById('data_retirada')?.value;
        const dataCancelamento = document.getElementById('data_cancelamento')?.value;
        const btnCancelar = document.getElementById('btn-cancelar-protocolo');
        if (btnCancelar) {
            if (dataRegistro || dataRetirada || dataCancelamento ) {
                btnCancelar.disabled = true;
                btnCancelar.title = "Não é possível cancelar após registro ou retirada.";
                btnCancelar.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                btnCancelar.disabled = false;
                btnCancelar.title = "Cancelar Protocolo";
                btnCancelar.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    }

    // Chama ao carregar a página
    atualizarBotaoCancelar();

// Event Listeners
    document.getElementById('btn-pesquisar-protocolo').addEventListener('click', () => {
    const numero = document.getElementById('numero_protocolo').value;
    if (!numero) return alert('Digite o número do protocolo!');

    fetch(`/protocolos/buscar/${numero}`)
        .then(response => response.json())
        .then(data => {
            if (data.erro) {
                alert(data.erro);
                return;
            }
            setValueById('protocolo_id', data.id);
            setValueById('data_abertura', data.data_abertura);
            setValueById('previsao', calcularPrevisao(data.data_abertura));
            setValueById('numero_protocolo', data.numero_protocolo);
            setValueById('numero_registro', data.numero_registro);
            setValueById('numero_documento_protocolo', data.numero_documento);
            setValueById('data_documento_protocolo', data.data_documento);
            setValueById('data_retirada', formatDateToInput(data.data_retirada));
            setValueById('data_registro', formatDateToInput(data.data_registro));
            setValueById('data_cancelamento', data.data_cancelamento);
            setSelectById('id_grupo', data.id_grupo);
            setSelectById('id_natureza', data.id_natureza);
            setSelectById('id_especie', data.id_especie);
            setValueById('apresentante_id', data.apresentante ? data.apresentante.id : '');
            atualizarBotaoCancelar();

            // Exibir mensagem se cancelado
            if (data.data_cancelamento) {
                exibirMensagemCancelado();
                bloquearAcoesProtocolo();
            } else {
                removerMensagemCancelado();
                desbloquearAcoesProtocolo();
            }

            // Aqui preenche o campo depósito:
            let deposito = Number(data.deposito);
            if (isNaN(deposito)) deposito = 0;
            setValueById('deposito', deposito.toFixed(2).replace('.', ','));

            if (data.apresentante) {
                setSelectById('id_documento_apresentante', data.apresentante.id_documento);
                setValueById('numero_documento_apresentante', data.apresentante.numero_documento);
                setValueById('nome_apresentante', data.apresentante.nome);
                setValueById('tipo_contato_apresentante', data.apresentante.tipo_contato);
                setValueById('numero_contato_apresentante', data.apresentante.numero_contato);
                setValueById('email_apresentante', data.apresentante.email);
            }

            const partes = data.partes || [];
            const parteContainer = document.getElementById('container-partes');
            if (parteContainer && partes.length > 0) {
                let linhas = parteContainer.querySelectorAll('.linha-parte');
                while (linhas.length < partes.length) {
                    const novaLinha = linhas[0].cloneNode(true);
                    novaLinha.querySelectorAll('input, select').forEach(el => el.value = '');
                    parteContainer.appendChild(novaLinha);
                    linhas = parteContainer.querySelectorAll('.linha-parte');
                }
                while (linhas.length > partes.length) {
                    parteContainer.removeChild(linhas[linhas.length - 1]);
                    linhas = parteContainer.querySelectorAll('.linha-parte');
                }
                linhas.forEach((linha, i) => {
                    const select = linha.querySelector('select[name="id_tipo_parte[]"]');
                    const input = linha.querySelector('input[name="identificacao[]"]');
                    if (select) select.value = partes[i]?.id_tipo_parte || '';
                    if (input) input.value = partes[i]?.identificacao || '';
                });
                aplicarMascarasDeVisualizacao();
            }

        })
        .catch(error => {
            alert('Erro ao buscar protocolo. Veja o log do servidor.');
            console.error('Erro ao buscar protocolo:', error);
            fetch('/log-js-error', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                body: JSON.stringify({ mensagem: error.message || error, stack: error.stack || null, protocolo: numero })
            });
        });
});

    document.getElementById('btn-retirar-protocolo').addEventListener('click', () => {
        const numeroProtocolo = document.getElementById('numero_protocolo').value;
        const dataRegistro = document.getElementById('data_registro')?.value;
        const dataCancelamento = document.getElementById('data_cancelamento')?.value;
        if (!numeroProtocolo) {
            alert('Número do protocolo não encontrado!');
            return;
        }
        if (dataCancelamento) {
            alert('Protocolo cancelado!');
            return;
        }
        if (!dataRegistro) {
            alert('Registro do protocolo não encontrado!');
            return;
        }
        fetch(`/protocolos/${numeroProtocolo}/atualizar-data-retirada`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.mensagem) {
                alert(data.mensagem);
                document.getElementById('data_retirada').value = new Date().toISOString().slice(0, 10);
            } else if (data.erro) {
                alert(data.erro);
            }
            setTimeout(atualizarBotaoCancelar, 500);
        })
        .catch(error => {
            alert('Erro ao atualizar data de retirada.');
            console.error(error);
        });
    });

    document.getElementById('btn-cancelar-protocolo').addEventListener('click', () => {
        const dataRegistro = document.getElementById('data_registro')?.value;
        const dataRetirada = document.getElementById('data_retirada')?.value;
        const numeroProtocolo = document.getElementById('numero_protocolo').value;
        if (!numeroProtocolo) {
            alert('Número do protocolo não encontrado!');
            return;
        }
        if(dataRegistro || dataRetirada) {
            alert('Não é possível cancelar após registro ou retirada.');
            return;
        }
        fetch(`/protocolos/${numeroProtocolo}/atualizar-data-cancelamento`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.mensagem) {
                alert(data.mensagem);
                document.getElementById('data_cancelamento').value = new Date().toISOString().slice(0, 10);
                atualizarBotaoCancelar();
            } else if (data.erro) {
                alert(data.erro);
            }
        })
        .catch(error => {
            alert('Erro ao atualizar data de cancelamento.');
            console.error(error);
        });
    });

    document.getElementById('botao-voltar').addEventListener('click', () => {
        window.location.href = '{{ route('dashboard') }}';
    });

    document.getElementById('btn-andamento')?.addEventListener('click', () => {
        try {
            var numero = document.getElementById('numero_protocolo').value;
            if (numero) {
                window.location.href = '/andamento?numero_protocolo=' + numero;
            } else {
                alert('Digite ou pesquise um número de protocolo antes de acessar o andamento!');
                console.error('Erro: número_protocolo não informado para gerar a URL de rota.');
                fetch('/log-js-error', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value },
                    body: JSON.stringify({ mensagem: 'Erro: número_protocolo não informado para gerar a URL de rota.', contexto: 'btn-andamento' })
                });
            }
        } catch (e) {
            console.error('Erro ao tentar gerar a URL de rota:', e);
            fetch('/log-js-error', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value },
                body: JSON.stringify({ mensagem: e.message, stack: e.stack, contexto: 'btn-andamento' })
            });
        }
    });

    document.getElementById('btn-protocolo-anterior').addEventListener('click', function() {
        const idAtual = document.getElementById('protocolo_id')?.value;
        if (idAtual) {
            window.location.href = `/protocolos/anterior/${idAtual}`;
        } else {
            alert('ID do protocolo não encontrado!');
        }
    });

    document.getElementById('btn-protocolo-seguinte').addEventListener('click', function() {
        const idAtual = document.getElementById('protocolo_id')?.value;
        if (idAtual) {
            window.location.href = `/protocolos/seguinte/${idAtual}`;
        } else {
            alert('ID do protocolo não encontrado!');
        }
    });

    document.getElementById('btn-editar-protocolo').addEventListener('click', function() {
        // Apresentante
        document.getElementById('id_documento_apresentante').disabled = false;
        document.querySelectorAll('#apresentante_grupo input, #apresentante_grupo select').forEach(el => {
            el.readOnly = false;
            el.disabled = false;
            el.style.pointerEvents = '';
            el.tabIndex = 0;
        });

        // Exibe botões de salvar/cancelar edição se desejar
        document.getElementById('btn-salvar-edicao-apresentante')?.classList.remove('hidden');
        document.getElementById('btn-cancelar-edicao-apresentante')?.classList.remove('hidden');

        apresentanteOriginal = {
        id_documento: document.getElementById('id_documento_apresentante').value,
        numero_documento: document.getElementById('numero_documento_apresentante').value,
        nome: document.getElementById('nome_apresentante').value,
        tipo_contato: document.getElementById('tipo_contato_apresentante').value,
        numero_contato: document.getElementById('numero_contato_apresentante').value,
        email: document.getElementById('email_apresentante').value,
        };

    });

    document.getElementById('btn-salvar-edicao-apresentante').addEventListener('click', function() {
    // Pegue o ID do apresentante (você precisa garantir que ele está disponível, ex: em um campo hidden)
    const apresentanteId = document.getElementById('apresentante_id')?.value;
    if (!apresentanteId) {
        alert('ID do apresentante não encontrado!');
        return;
    }

    // Pegue os valores dos campos
    const dados = {
        id_documento: document.getElementById('id_documento_apresentante').value,
        numero_documento: document.getElementById('numero_documento_apresentante').value,
        nome: document.getElementById('nome_apresentante').value,
        tipo_contato: document.getElementById('tipo_contato_apresentante').value,
        numero_contato: document.getElementById('numero_contato_apresentante').value,
        email: document.getElementById('email_apresentante').value,
    };

    fetch(`/apresentantes/${apresentanteId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(dados)
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            alert(data.mensagem);
            // Volta os campos para readonly
            document.querySelectorAll('#apresentante_grupo input, #apresentante_grupo select').forEach(el => {
                el.readOnly = true;
                el.disabled = true;
                el.style.pointerEvents = 'none';
                el.tabIndex = -1;
            });
            document.getElementById('btn-salvar-edicao-apresentante').classList.add('hidden');
            document.getElementById('btn-cancelar-edicao-apresentante').classList.add('hidden');
        } else {
            alert('Erro ao atualizar apresentante!');
        }
    })
    .catch(() => alert('Erro ao atualizar apresentante!'));
});
    document.getElementById('btn-cancelar-edicao-apresentante').addEventListener('click', function() {
        // Restaura os valores originais
        document.getElementById('id_documento_apresentante').value = apresentanteOriginal.id_documento;
        document.getElementById('numero_documento_apresentante').value = apresentanteOriginal.numero_documento;
        document.getElementById('nome_apresentante').value = apresentanteOriginal.nome;
        document.getElementById('tipo_contato_apresentante').value = apresentanteOriginal.tipo_contato;
        document.getElementById('numero_contato_apresentante').value = apresentanteOriginal.numero_contato;
        document.getElementById('email_apresentante').value = apresentanteOriginal.email;

        // Volta os campos para readonly
        document.querySelectorAll('#apresentante_grupo input, #apresentante_grupo select').forEach(el => {
            el.readOnly = true;
            el.disabled = true;
            el.style.pointerEvents = 'none';
            el.tabIndex = -1;
        });
        document.getElementById('btn-salvar-edicao-apresentante').classList.add('hidden');
        document.getElementById('btn-cancelar-edicao-apresentante').classList.add('hidden');
    });

</script>