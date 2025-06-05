<x-app-layout>
    <x-slot name="title">Andamento</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">
            {{ __('Andamento') }}
        </h2>
    </x-slot>

    <style>
        .campo-formulario {
            border: 0px;
            padding: 8px;
        }
    </style>

    <div class="max-w-[75%] mx-auto w-full px-4">
        {{-- TODO: Criar o endpoint para o formulário --}}
        <form id="andamento_form" action="/protocolos" method="post">
            @csrf

            <div class="flex items-center justify-between w-[92%] h-20 mx-auto rounded-t-md px-6 mb-2">
    <!-- Campo de formulário -->
    <div class="campo-formulario flex items-center -ml-8">
        <div class="text-left">
            <x-input-label for="numero_documento">Protocolo</x-input-label>
            <x-input-naoalteravel id="numero_protocolo" name="numero_protocolo" class="w-[150px] h-8 text-sm">
            </x-input-naoalteravel>
        </div>
    </div>

<div class="w-70 h-10 rounded-md flex items-center px-2 ml-auto space-x-2 -mr-8">
   

        <div class="flex items-center w-20 h-9 bg-[#9f9f9f] rounded-md flex items-center justify-center ">
   
    <button type="button" id="andamento_adicionar" class="bg-[#9f9f9f] text-black px-3 py-1 rounded" title="Adicionar Andamento">
        +
    </button>

    <!-- Botão salvar -->
    <button type="submit"
        class="w-9 h-9 bg-[#9f9f9f] rounded-md flex items-center justify-center " title="Salvar">
        <img src="{{ asset('images/Salvar.png') }}" alt="Salvar" class="w-4 h-4" />
    </button>
</div>

    


    <!-- Botão voltar -->
    <div class="w-9 h-9 bg-[#9f9f9f] rounded-full flex items-center justify-center hover:bg-[#8a8a8a]">
        <button id="botao-voltar" type="button" onclick="window.location.href='{{ route('protocolos.view') }}'" class="w-full h-full flex items-center justify-center ">
            <img src="{{ asset('images/Voltar.png') }}" alt="Voltar" class="w-4 h-4" />
        </button>
    </div>
</div>



</div>

        <div class="flex justify-start w-[92%] h-10 mx-auto bg-[#9f9f9f] rounded-t-md">
    <div class="text-left flex items-center ml-6 mr-20">
        <x-input-label for="numero_documento">Data/Hora</x-input-label>
    </div>

    <div class="text-left flex items-center mr-24 ">
        <x-input-label for="numero_documento">Tipo de Andamento</x-input-label>
    </div>

    <div class="text-left flex items-center mr-24">
        <x-input-label for="numero_documento">Valor</x-input-label>
    </div>

    <div class="text-left flex items-center mr-[195px] ml-6" >
        <x-input-label for="numero_documento">Observação</x-input-label>
    </div>

    <div class="text-left flex items-center ml-28 ">
        <x-input-label for="numero_documento">Origem</x-input-label>
    </div>
</div>


<div id="andamento_container">
            <div class="flex justify-start w-[92%] h-[54px] mx-auto bg-white rounded-b-md andamento-bloco">
               
            <div class="campo-formulario flex items-center ml-4">

                 <x-text-input id="data_hora" name="data_hora" class="w-[110px] h-8 text-sm" data-tipo="data-hora" required value="{{ now()->format('d/m/Y') }}" readonly/>
            </div>

                <!-- TODO: confirmar id -->
                 <div class="campo-formulario flex items-center ml-4">
                        <x-input-select id="id_tipo_andamento" name="id_tipo_andamento" class="w-[190px] h-8 text-sm" data-default="1" required>
                        <option value="1">Título Registrado</option>
                        <option value="2">Valor Autenticado</option>
                        <option value="3">Título Pronto para Retirada</option>
                    </x-input-select>
                </div>

                <div class="campo-formulario flex items-center ml-4">
                    <x-input-number type="text" id="valor" name="valor" class="w-[120px] h-8 text-sm" required>
                                    </x-input-number>
                </div>
                
                <div class="campo-formulario flex items-center ml-4">
                        <x-text-input id="observacao" name="observacao" class="w-[350px] h-8 text-sm" required />
                </div>

                <!-- TODO: Puxar usuario -->
                <div class="campo-formulario flex items-center ml-4">
                        <x-text-input id="id_usuario" name="id_usuario" class="w-[200px] h-8 text-sm" value="{{ Auth::user() ? Auth::user()->nome : '' }}" readonly required />
                </div>
                
    </div>

    

        </form>
    </div>

    <script>
  document.getElementById('andamento_adicionar').addEventListener('click', function () {
    const container = document.getElementById('andamento_container');
    const blocoOriginal = container.querySelector('.andamento-bloco');
    const novoBloco = blocoOriginal.cloneNode(true);

    // Limpa os valores
    novoBloco.querySelectorAll('input, select').forEach(element => {
        element.value = '';
        element.removeAttribute('readonly');
        element.removeAttribute('disabled');
    });

    // Preenche data atual
    const inputData = novoBloco.querySelector('input[data-tipo="data-hora"]');
    if(inputData) {
        const hoje = new Date();
        const dia = String(hoje.getDate()).padStart(2, '0');
        const mes = String(hoje.getMonth() + 1).padStart(2, '0');
        const ano = hoje.getFullYear();
        inputData.value = `${dia}/${mes}/${ano}`;
    }

    // Setar valor padrão do select
    const selectTipo = novoBloco.querySelector('select#id_tipo_andamento');
    if (selectTipo) {
      const defaultVal = selectTipo.getAttribute('data-default');
      if (defaultVal) selectTipo.value = defaultVal;
    }

    container.appendChild(novoBloco);
});


</script>

<script>
document.getElementById('andamento_form').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita que a página seja recarregada

    // 1. Torna todos os campos dos blocos já adicionados como readonly/disabled
    const blocos = document.querySelectorAll('.andamento-bloco');
    blocos.forEach(bloco => {
        bloco.querySelectorAll('input, select').forEach(element => {
            element.setAttribute('readonly', true);
            element.setAttribute('disabled', true); // Para selects
        });
    });

    // 2. Simula envio do formulário (remova esta parte se quiser envio real)
    console.log("Simulando envio dos dados do formulário...");

    // 3. Se quiser enviar realmente via fetch ou ajax:
    // const formData = new FormData(this);
    // fetch(this.action, {
    //     method: this.method,
    //     body: formData,
    //     headers: {
    //         'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
    //     }
    // }).then(res => res.json()).then(data => {
    //     console.log('Enviado com sucesso!', data);
    // });

    // Obs: você pode limpar ou deixar pronto para o próximo preenchimento aqui também.
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const protocolo = sessionStorage.getItem('protocolo_atual');
        if (protocolo) {
            const inputProtocolo = document.getElementById('numero_protocolo');
            if (inputProtocolo) {
                inputProtocolo.value = protocolo;
                inputProtocolo.setAttribute('readonly', true); // evita edição
            }
        }
    });
</script>



</x-app-layout>

