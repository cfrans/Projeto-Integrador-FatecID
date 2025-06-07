<x-app-layout>
    <x-slot name="title">Andamento</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">Andamento</h2>
    </x-slot>

    <style>
        .campo-formulario { border: 0px; padding: 8px; }
    </style>

    <div class="max-w-[75%] mx-auto w-full px-4">
        <form id="andamento_form" action="{{ route('andamento.store') }}" method="post">
            @csrf

            <!-- Cabeçalho do formulário -->
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
                    <!-- Botão adicionar -->
                     <div class="w-57 h-10 rounded-md flex items-center bg-[#9f9f9f]">
                    <button type="button" id="andamento_adicionar" class="bg-[#9f9f9f] text-black px-3 py-1 rounded ml-2" title="Adicionar Andamento">
                        +
                    </button>

                    <!-- Botão salvar -->
                    <button type="submit" class="w-9 h-9 bg-[#9f9f9f] rounded-md flex items-center justify-center mr-2" title="Salvar">
                        <img src="{{ asset('images/Salvar.png') }}" alt="Salvar" class="w-4 h-4" />
                    </button>
</div>

                    <!-- Botão voltar -->
                    <div class="w-9 h-9 bg-[#9f9f9f] rounded-full flex items-center justify-center hover:bg-[#8a8a8a]">
    <button id="botao-voltar" type="button" onclick="window.history.back()" class="w-full h-full flex items-center justify-center">
        <img src="{{ asset('images/Voltar.png') }}" alt="Voltar" class="w-4 h-4" />
    </button>
</div>
                </div>
            </div>

            <!-- Títulos dos campos -->
            <div class="flex justify-start w-[92%] h-10 mx-auto bg-[#9f9f9f] rounded-t-md">
                <div class="text-left flex items-center ml-6 mr-20"><x-input-label>Data/Hora</x-input-label></div>
                <div class="text-left flex items-center mr-24"><x-input-label>Tipo de Andamento</x-input-label></div>
                <div class="text-left flex items-center mr-24"><x-input-label>Valor</x-input-label></div>
                <div class="text-left flex items-center mr-[195px] ml-6"><x-input-label>Observação</x-input-label></div>
                <div class="text-left flex items-center ml-28"><x-input-label>Origem</x-input-label></div>
            </div>

            <!-- Container de Andamentos -->
            <div id="andamento_container">
                <!-- Andamentos já existentes (readonly) -->
@foreach ($andamentos ?? [] as $and)
<div class="flex justify-start w-[92%] h-[54px] mx-auto bg-white rounded-b-md andamento-bloco">
    <div class="campo-formulario flex items-center ml-4">
        <x-text-input class="w-[110px] h-8 text-sm" value="{{ \Carbon\Carbon::parse($and->data_hora)->format('d/m/Y') }}" readonly />
    </div>

    <div class="campo-formulario flex items-center ml-4">
        <x-input-select class="w-[190px] h-8 text-sm" disabled>
            <option value="1" {{ $and->id_tipo_andamento == 1 ? 'selected' : '' }}>Título Registrado</option>
            <option value="2" {{ $and->id_tipo_andamento == 2 ? 'selected' : '' }}>Valor Autenticado</option>
            <option value="3" {{ $and->id_tipo_andamento == 3 ? 'selected' : '' }}>Título Pronto para Retirada</option>
        </x-input-select>
    </div>

    <div class="campo-formulario flex items-center ml-4">
        <x-input-number class="w-[120px] h-8 text-sm" value="{{ $and->valor }}" readonly />
    </div>

    <div class="campo-formulario flex items-center ml-4">
        <x-text-input class="w-[350px] h-8 text-sm" value="{{ $and->observacao }}" readonly />
    </div>

    <div class="campo-formulario flex items-center ml-4">
        <x-text-input class="w-[200px] h-8 text-sm" value="{{ $and->usuario->nome ?? '' }}" readonly />
    </div>
</div>
@endforeach
            </div>

            <!-- Template escondido para novos andamentos -->
            <template id="template_andamento">
                <div class="flex justify-start w-[92%] h-[54px] mx-auto bg-white rounded-b-md andamento-bloco">
                    <div class="campo-formulario flex items-center ml-4">
                        <x-text-input name="data_hora[]" class="w-[110px] h-8 text-sm" data-tipo="data-hora" required />
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-input-select name="id_tipo_andamento[]" class="w-[190px] h-8 text-sm" required>
                            <option value="1" selected>Título Registrado</option>
                            <option value="2">Valor Autenticado</option>
                            <option value="3">Título Pronto para Retirada</option>
                        </x-input-select>
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-input-number name="valor[]" class="w-[120px] h-8 text-sm" required />
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-text-input name="observacao[]" class="w-[350px] h-8 text-sm" required />
                    </div>

                    <div class="campo-formulario flex items-center ml-4">
                        <x-text-input name="nome_usuario[]" class="w-[350px] h-8 text-sm" value="{{ Auth::user()->nome }}" readonly />
                    </div>
                </div>
            </template>
        </form>
    </div>

    <script>
    document.getElementById('andamento_adicionar').addEventListener('click', function () {
        const template = document.getElementById('template_andamento');
        const clone = template.content.cloneNode(true);
        
        // Preenche a data atual no campo de data
        const hoje = new Date();
        const dia = String(hoje.getDate()).padStart(2, '0');
        const mes = String(hoje.getMonth() + 1).padStart(2, '0');
        const ano = hoje.getFullYear();
        const dataAtual = `${dia}/${mes}/${ano}`;
        
        const dataInput = clone.querySelector('[data-tipo="data-hora"]');
        if (dataInput) dataInput.value = dataAtual;

        document.getElementById('andamento_container').appendChild(clone);
    });
</script>


    </script>
</x-app-layout>

