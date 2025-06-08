<x-app-layout>
    <x-slot name="title">Andamento</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">Andamento</h2>
    </x-slot>

    @if(!empty($data_retirada))
        <div class="bg-yellow-200 text-yellow-800 px-4 py-2 rounded mb-4 font-bold">
            Este protocolo já possui data de retirada. Os dados estão em modo de visualização.
        </div>
    @endif

    <style>
        .campo-formulario { border: 0px; padding: 8px; }
    </style>

    <div class="max-w-[75%] mx-auto w-full px-4">
        <form id="andamento_form" action="{{ route('andamento.store') }}" method="post">
            @csrf

            <div class="flex items-center justify-between w-[92%] h-20 mx-auto rounded-t-md px-6 mb-2">
                <div class="campo-formulario flex items-center -ml-8">
                    <div class="text-left">
                        <x-input-label for="numero_protocolo">Protocolo</x-input-label>
                        <x-input-naoalteravel
                            id="numero_protocolo"
                            name="numero_protocolo"
                            class="w-[150px] h-8 text-sm"
                            value="{{ $numeroProtocolo ?? '' }}"
                            readonly
                        />
                    </div>
                </div>

                <div class="w-70 h-10 rounded-md flex items-center px-2 ml-auto space-x-2 -mr-8 ">
                    <div class="w-57 h-10 rounded-md flex items-center bg-[#9f9f9f]">
                        @if(empty($data_retirada))
                        <button type="button" id="andamento_adicionar" class="bg-[#9f9f9f] transition-transform duration-400 ease-in-out hover:scale-125 text-black px-3 py-1 rounded ml-2" title="Adicionar Andamento">
                            +
                        </button>
                        @endif

                    @if(empty($data_retirada))
                        <button type="submit" class="w-9 h-9 bg-[#9f9f9f] rounded-md flex items-center justify-center mr-2" title="Salvar">
                            <img src="{{ asset('images/Salvar.png') }}" alt="Salvar" class="w-4 h-4 transition-transform duration-400 ease-in-out hover:scale-125" />
                        </button>
                    @endif
                    </div>

                    <div class="w-9 h-9 bg-[#9f9f9f] rounded-full flex items-center justify-center hover:bg-[#8a8a8a]">
                        <button id="botao-voltar" type="button" onclick="window.history.back()" class="w-full h-full flex items-center justify-center">
                            <img src="{{ asset('images/Voltar.png') }}" alt="Voltar" class="w-4 h-4" />
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-start w-[92%] h-10 mx-auto bg-[#9f9f9f] rounded-t-md space-x-4"> <div class="text-left flex items-center ml-4 w-[180px]"> {{-- Ajustado w-[...] --}}
                    <x-input-label>Data/Hora</x-input-label>
                </div>
                <div class="text-left flex items-center w-[205px]"> {{-- Ajustado w-[...] --}}
                    <x-input-label>Tipo de Andamento</x-input-label>
                </div>
                <div class="text-left flex items-center w-[135px]"> {{-- Ajustado w-[...] --}}
                    <x-input-label>Valor</x-input-label>
                </div>
                <div class="text-left flex items-center w-[365px]"> {{-- Ajustado w-[...] --}}
                    <x-input-label>Observação</x-input-label>
                </div>
                <div class="text-left flex items-center w-[200px]"> {{-- Ajustado w-[...] --}}
                    <x-input-label>Origem</x-input-label>
                </div>
            </div>

            <div id="andamento_container">
                @foreach ($andamentos ?? [] as $and)
                <div class="flex justify-start w-[92%] h-[54px] mx-auto bg-white rounded-b-md andamento-bloco">
                    <div class="campo-formulario flex items-center ml-4">
                        {{-- AQUI: Alterado de w-[110px] para w-[150px] --}}
                        <x-text-input class="w-[150px] h-8 text-sm" value="{{ \Carbon\Carbon::parse($and->data_hora)->format('d/m/Y H:i') }}" readonly />
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-input-select name="id_tipo_andamento_disabled[]" class="w-[190px] h-8 text-sm" disabled>
                            <option value="1" {{ $and->id_tipo_andamento == 1 ? 'selected' : '' }}>Título Registrado</option>
                            <option value="2" {{ $and->id_tipo_andamento == 2 ? 'selected' : '' }}>Valor Autenticado</option>
                            <option value="3" {{ $and->id_tipo_andamento == 3 ? 'selected' : '' }}>Título Pronto para Retirada</option>
                        </x-input-select>
                        <input type="hidden" name="id_tipo_andamento_existente[]" value="{{ $and->id_tipo_andamento }}">
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-input-number name="valor_existente[]" data-moeda class="w-[120px] h-8 text-sm" value="{{ number_format($and->valor, 2, ',', '.') }}" readonly />
                        <input type="hidden" name="valor_existente_raw[]" value="{{ $and->valor }}">
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-text-input name="observacao_existente[]" class="w-[350px] h-8 text-sm" value="{{ $and->observacao }}" readonly />
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-text-input name="nome_usuario_existente[]" class="w-[200px] h-8 text-sm" value="{{ $and->usuario->nome ?? '' }}" readonly />
                        <input type="hidden" name="id_usuario_existente[]" value="{{ $and->id_usuario }}">
                        <input type="hidden" name="data_hora_existente[]" value="{{ \Carbon\Carbon::parse($and->data_hora)->format('d/m/Y H:i') }}">
                    </div>
                </div>
                @endforeach
            </div>

            <template id="template_andamento">
                <div class="flex justify-start w-[92%] h-[54px] mx-auto bg-white rounded-b-md andamento-bloco">
                    <div class="campo-formulario flex items-center ml-4">
                        {{-- AQUI: Alterado de w-[110px] para w-[150px] --}}
                        <x-text-input name="data_hora[]" class="w-[150px] h-8 text-sm" data-tipo="data-hora" required />
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-input-select name="id_tipo_andamento[]" class="w-[190px] h-8 text-sm" required>
                            <option value="1" selected>Título Registrado</option>
                            <option value="2">Valor Autenticado</option>
                            <option value="3">Título Pronto para Retirada</option>
                        </x-input-select>
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-input-number name="valor[]" data-moeda class="w-[120px] h-8 text-sm" value="0,00" required />
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-text-input name="observacao[]" class="w-[350px] h-8 text-sm" required />
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-text-input name="nome_usuario[]" class="w-[200px] h-8 text-sm" value="{{ Auth::user()->nome }}" readonly />
                        <input type="hidden" name="id_usuario_novo[]" value="{{ Auth::user()->id }}">
                    </div>
                </div>
            </template>
        </form>
    </div>

    {{-- Script para adicionar andamento e aplicar máscara --}}
    <script>
        document.getElementById('andamento_adicionar').addEventListener('click', function () {
            const template = document.getElementById('template_andamento');
            const clone = template.content.cloneNode(true);

            // Verifica os tipos de andamento já existentes
            const tiposExistentes = Array.from(document.querySelectorAll('input[name="id_tipo_andamento_existente[]"]'))
                .map(input => input.value);

            // Função para saber se já existe um tipo específico
            const existeTipo = tipo => tiposExistentes.includes(tipo.toString());

            // Monta as opções do select conforme a regra
            let opcoes = '';
            if (!existeTipo(2)) {
                // Só pode adicionar "Valor Autenticado"
                opcoes = `<option value="2" selected>Valor Autenticado</option>`;
            } else if (!existeTipo(1)) {
                // Só pode adicionar "Título Registrado"
                opcoes = `<option value="1" selected>Título Registrado</option>`;
            } else {
                // Só pode adicionar "Título Pronto para Retirada"
                opcoes = `<option value="3" selected>Título Pronto para Retirada</option>`;
            }

            // Atualiza o select do clone
            const select = clone.querySelector('select[name="id_tipo_andamento[]"]');
            if (select) {
                select.innerHTML = opcoes;
            }

            // Preenche data/hora atual
            const hoje = new Date();
            const dia = String(hoje.getDate()).padStart(2, '0');
            const mes = String(hoje.getMonth() + 1).padStart(2, '0');
            const ano = hoje.getFullYear();
            const horas = String(hoje.getHours()).padStart(2, '0');
            const minutos = String(hoje.getMinutes()).padStart(2, '0');
            const dataAtual = dia + '/' + mes + '/' + ano + ' ' + horas + ':' + minutos;
            const dataInput = clone.querySelector('[data-tipo="data-hora"]');
            if (dataInput) dataInput.value = dataAtual;

            // Máscara de moeda
            const novoCampoValor = clone.querySelector('[name="valor[]"][data-moeda]');
            if (novoCampoValor) {
                aplicarMascaraMoeda(novoCampoValor);
                novoCampoValor.addEventListener('input', function() {
                    aplicarMascaraMoeda(this);
                });
            }

            document.getElementById('andamento_container').appendChild(clone);
        });

        /**
         * Aplica a máscara de moeda (R$ X.XXX,YY) a um campo de input.
         * @param {HTMLInputElement} input - O elemento input a ser mascarado.
         */
        function aplicarMascaraMoeda(input) {
            let valor = input.value.replace(/\D/g, '');
            if (valor === '') {
                input.value = '0,00';
                return;
            }
            valor = (parseInt(valor, 10) / 100).toFixed(2);
            input.value = valor.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        /**
         * Converte uma string formatada como moeda (R$ X.XXX,YY) para um float (X.YYY.ZZ).
         * @param {string} valor - A string de moeda a ser desformatada.
         * @returns {number} O valor numérico desformatado.
         */
        function desformatarMoeda(valor) {
            return parseFloat(valor.replace(/\./g, '').replace(',', '.')) || 0;
        }

        // Aplica a máscara aos campos de valor editáveis existentes ao carregar a página
        document.querySelectorAll('[data-moeda]').forEach(function(campo) {
            if (!campo.readOnly) {
                aplicarMascaraMoeda(campo);
                campo.addEventListener('input', function() {
                    aplicarMascaraMoeda(this);
                });
            }
        });

        // Intercepta o submit do formulário para desformatar os valores de moeda antes do envio.
        document.getElementById('andamento_form').addEventListener('submit', async function(e) {
            e.preventDefault();

            // Crie um novo FormData para coletar APENAS os dados que queremos enviar
            const formDataToSubmit = new FormData();
            
            // Adicione o token CSRF
            const csrfToken = this.querySelector('input[name="_token"]');
            if (csrfToken) {
                formDataToSubmit.append(csrfToken.name, csrfToken.value);
            }
            
            // Adicione o numero_protocolo
            const numeroProtocoloInput = this.querySelector('input[name="numero_protocolo"]');
            if (numeroProtocoloInput) {
                formDataToSubmit.append(numeroProtocoloInput.name, numeroProtocoloInput.value);
            }

            // Coleta e desformata os campos de andamento NOVOS (editáveis)
            // e coleta os campos de andamento EXISTENTES (readonly)
            document.querySelectorAll('.andamento-bloco').forEach(function(bloco) {
                const dataInput = bloco.querySelector('[name="data_hora[]"]'); // Campo data_hora para novos
                const tipoInput = bloco.querySelector('[name="id_tipo_andamento[]"]'); // Campo tipo para novos
                const valorInput = bloco.querySelector('[name="valor[]"]'); // Campo valor para novos
                const observacaoInput = bloco.querySelector('[name="observacao[]"]'); // Campo observacao para novos
                const usuarioInput = bloco.querySelector('[name="nome_usuario[]"]'); // Campo nome do usuário para novos
                const idUsuarioInput = bloco.querySelector('[name="id_usuario_novo[]"]'); // Campo ID do usuário para novos

                // Campos para andamentos existentes (readonly)
                const dataHoraExistente = bloco.querySelector('input[name="data_hora_existente[]"]');
                const idTipoAndamentoExistente = bloco.querySelector('input[name="id_tipo_andamento_existente[]"]');
                const valorExistenteRaw = bloco.querySelector('input[name="valor_existente_raw[]"]');
                const observacaoExistente = bloco.querySelector('input[name="observacao_existente[]"]');
                const idUsuarioExistente = bloco.querySelector('input[name="id_usuario_existente[]"]');
                
                if (dataInput && !dataInput.readOnly) { // É um andamento NOVO (editável)
                    formDataToSubmit.append('data_hora[]', dataInput.value);
                    formDataToSubmit.append('id_tipo_andamento[]', tipoInput ? tipoInput.value : '');
                    formDataToSubmit.append('valor[]', desformatarMoeda(valorInput ? valorInput.value : '0,00'));
                    formDataToSubmit.append('observacao[]', observacaoInput ? observacaoInput.value : '');
                    formDataToSubmit.append('id_usuario[]', idUsuarioInput ? idUsuarioInput.value : '');
                } else if (dataHoraExistente && dataHoraExistente.readOnly) { // É um andamento EXISTENTE (readonly)
                    formDataToSubmit.append('data_hora[]', dataHoraExistente.value);
                    formDataToSubmit.append('id_tipo_andamento[]', idTipoAndamentoExistente ? idTipoAndamentoExistente.value : '');
                    formDataToSubmit.append('valor[]', valorExistenteRaw ? valorExistenteRaw.value : '0.00');
                    formDataToSubmit.append('observacao[]', observacaoExistente ? observacaoExistente.value : '');
                    formDataToSubmit.append('id_usuario[]', idUsuarioExistente ? idUsuarioExistente.value : '');
                }
            });

            console.info('Dados do formulário de andamento sendo enviados:');
            for (const [key, value] of formDataToSubmit.entries()) {
                console.info(`${key}: ${value}`);
            }

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formDataToSubmit
                });

                let data;
                try {
                    data = await response.json();
                } catch (jsonError) {
                    console.error('Erro ao parsear JSON da resposta:', jsonError);
                    data = { success: false, message: 'Resposta inválida do servidor.' };
                }

                if (response.ok && data.success) {
                    // alert(data.message || 'Andamento(s) salvo(s) com sucesso!');
                    const currentProtocolo = document.getElementById('numero_protocolo').value;
                    window.location.href = `/andamento?numero_protocolo=${currentProtocolo}`;
                } else {
                    let errorMessage = data.message || 'Erro desconhecido ao salvar andamento(s).';
                    if (data.errors) {
                        for (const key in data.errors) {
                            errorMessage += `\n${key}: ${data.errors[key].join(', ')}`;
                        }
                    }
                    alert(errorMessage);
                }

            } catch (error) {
                console.error('Erro na requisição AJAX ou de conexão:', error);
                alert('Erro de conexão ou problema no servidor. Tente novamente.');
            } finally {
                document.querySelectorAll('[data-moeda]').forEach(function(campo) {
                    if (!campo.readOnly) {
                        aplicarMascaraMoeda(campo);
                    }
                });
            }
        });
    </script>
</x-app-layout>