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

    <div class="w-full flex">
  <div class="w-60 h-11 bg-gray-200 rounded-md mt-6 ml-auto mr-14 flex items-center justify-center">
    <button class=" w-12 h-12 flex items-center justify-center">
      <img src="{{ asset('images/salvar.png') }}" alt="Salvar" class="w-6 h-6" />
    </button>
  </div>
</div>

    {{-- TODO: Criar o endpoint para o formulario --}}
    <form action="/endpoint" method="post">

        <x-input-label for="protocolo_grupo" class="ml-16">
                        Dados do Protocolo
                    </x-input-label>


        {{-- DIV MENOR PARA O CONTEUDO DOS CAMPOS --}}
        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-t-md">


            <!-- Primeira coluna (2/7) -->
            <div class="campo-formulario flex items-center ml-6"> 
                <div class="text-left">
                    <x-input-label for="protocolo_grupo">
                        Grupo
                    </x-input-label>

                    <x-input-select id="protocolo_grupo" name="protocolo_grupo" class="w-[200px] h-7.5 text-sm" required>
                            <option value="protocolo_grupo_td">Títulos e Documentos</option>
                            <option value="protocolo_grupo_pj">Pessoa Jurídica</option>
                    </x-input-select>
                </div>
            </div>


            <!-- Segunda coluna (2/7) -->
             <div class="campo-formulario flex items-center"> 
                <div class="text-left">
                    <x-input-label for="protocolo_natureza">
                        Natureza
                    </x-input-label>
                    <x-input-select id="protocolo_natureza" name="protocolo_natureza " class="w-[400px] h-8 text-sm" required>
                        <option value="protocolo_natureza_01">Natureza 01</option>
                        <option value="protocolo_natureza_02">Natureza 02</option>
                        {{-- TODO: Confirmar os tipos de natureza --}}
                    </x-input-select>
                </div>
            </div>

            <!-- Terceira coluna (2/7) -->
             <div class="campo-formulario flex items-center">
                <div class="text-left">
                <x-input-label for="protocolo_especie">
                    Espécie
                </x-input-label>
                <x-input-select id="protocolo_especie" name="protocolo_especie" class="w-[200px] h-8 text-sm" required>
                    <option value="protocolo_especie_registro">Registro</option>
                    <option value="protocolo_especie_averbacao">Averbação</option>
                </x-input-select>
                </div>
            </div>

            <!-- Quarta coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="protocolo_numero_protocolo">
                        Protocolo
                    </x-input-label>
                    <x-text-input  id="protocolo_numero_protocolo" name="protocolo_numero_protocolo" class="w-[200px] h-8 text-sm" required>
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
                    <x-input-date type="date" id="protocolo_data" name="protocolo_data" class="w-[150px] h-8 text-sm" required />
                    {{-- TODO: Confirmar o formato da data e se vai ser editável --}}
                </div>
            </div>
        
        </div> 
        
        <!--parte de cima-->

        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-b-md">

            <!-- Primeira coluna (1/7) -->
           <div class="campo-formulario flex items-center ml-6">
                <div class="text-left">
                    <x-input-label for="protocolo_numero_documento">
                        Nº Documento / Título
                    </x-input-label>
                    <x-text-input id="protocolo_numero_documento" name="protocolo_numero_documento" class="w-[200px] h-8 text-sm" required />
                </div>
            </div>

            <!-- Segunda coluna (1/7) -->
             <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="protocolo_data_documento">
                        Data do documento
                    </x-input-label>
                    <x-input-date type="date" id="protocolo_data_documento" name="protocolo_data_documento" class="w-[150px] h-8 text-sm" required>
                    </x-input-date>
                </div>
            </div>


            <!-- Terceira coluna (1/7) -->
           <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="protocolo_previsao">
                        Previsão
                    </x-input-label>
                    <x-input-date type="date" id="protocolo_previsao" name="protocolo_previsao" class="w-[150px] h-8 text-sm" required>
                    {{-- TODO: Confirmar se tambem é editável ou só calcular o prazo a partir da data inicial --}}
                    </x-input-date>
                </div>
            </div>

            <!-- Quarta coluna (1/7) -->
          <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="protocolo_cancelamento">
                        Cancelamento
                    </x-input-label>
                    <x-input-date type="date" id="protocolo_cancelamento" name="protocolo_cancelamento" class="w-[150px] h-8 text-sm" required />
                </div>
            </div>
            <!-- TODO: CAMPO NAO EDITAVEL -->

            <!-- Quinta coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="protocolo_data_registro">
                        Data de registro
                    </x-input-label>
                    <x-input-date type="date" id="protocolo_data_registro" name="protocolo_data_registro" class="w-[150px] h-8 text-sm" required>
                    </x-input-date>
                </div>
            </div>

            <!-- Sexta coluna (1/7) -->
            <div class="campo-formulario flex items-center">
                <div class="text-left">
                    <x-input-label for="protocolo_data_de_retirada">
                        Data de Retirada
                    </x-input-label>
                    <x-input-date type="date" id="protocolo_data_de_retirada" name="protocolo_data_de_retirada" class="w-[150px] h-8 text-sm" required>
                    </x-input-date>
                </div>
            </div>
        </div> 
        
        <!--acaba aqui-->
    

        <x-input-label for="protocolo_grupo" class="ml-16 mt-8">
                        Dados do Apresentante
                    </x-input-label>

        <div class="flex justify-start w-[92%] h-20 mx-auto bg-white rounded-t-md">
                    <!-- Primeira coluna (1/7) -->
                   <div class="campo-formulario flex items-center ml-6"> 
                <div class="text-left">
                <x-input-label for="apresentante_documento">
                    Documento
                </x-input-label>
                <x-input-select id="apresentante_documento" name="apresentante_documento " class="w-[150px] h-8 text-sm" required>
                    <option value="apresentante_documento_rg">RG</option>
                    <option value="apresentante_documento_cpf">CPF</option>
                    <option value="apresentante_documento_cnh">CNH</option>
                </x-input-select>
            </div>
        </div>
            

            <!-- Segunda coluna (1/7) -->
            <div class="campo-formulario flex items-center"> 
                <div class="text-left">
                <x-input-label for="apresentante_numero_documento">
                    Número do Documento
                </x-input-label>
                <x-text-input type="text" id="apresentante_numero_documento" name="apresentante_numero_documento" class="w-[200px] h-8 text-sm" required>
            </x-text-input>
            </div>
            </div>

            <!-- Terceira coluna (3/7) -->
            <div class="campo-formulario flex items-center"> 
                <div class="text-left">
                <x-input-label for="apresentante_nome">
                    Nome
                </x-input-label>
                <x-text-input type="text" id="apresentante_nome" name="apresentante_nome" class="w-[800px] h-8 text-sm" required>
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
                <x-text-input type="text" id="apresentante_tipo_contato" name="apresentante_tipo_contato" class="w-[150px] h-8 text-sm" required>
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
                <x-text-input type="text" id="apresentante_numero_contato" name="apresentante_numero_contato" class="w-[200px] h-8 text-sm" required>
                </x-text-input>
            </div>
            </div>

            <!-- Terceira coluna (5/7) -->
            <div class="campo-formulario flex items-center"> 
                <div class="text-left">
                <x-input-label for="apresentante_email">
                    E-mail
                </x-input-label>
                <x-text-input type="email" id="apresentante_email" name="apresentante_email" class="w-[800px] h-8 text-sm" required>
            </x-text-input>
            </div>
            </div>
        </div>

        <x-input-label for="protocolo_grupo" class="ml-16 mt-8">
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
                        <x-input-select name="parte_tipo[]" class="w-[365px] h-8 text-sm" required>
                            <option value="fisica">Física</option>
                            <option value="juridica">Jurídica</option>
                        </x-input-select>
                     </div>
                    </div>

                    <!-- Segunda coluna (3/7) -->
                   <div class="campo-formulario flex items-center"> 
                <div class="text-left">
                        <x-input-label for="parte_nome">
                            Nome / Razão Social
                        </x-input-label>
                        <x-text-input type="text" name="parte_nome[]" class="w-[600px] h-8 text-sm" required>
                        </x-text-input>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Botão adicionar -->
            <div class="w-[85%] mx-auto -mt-12 text-right">
            <button type="button" id="parte_adicionar" class="bg-gray-400 text-white px-3 py-1 rounded hover:bg-blue-600">+</button>
            </div>

        </div>

        <script>
            document.getElementById("parte_adicionar").addEventListener("click", function () {
                let container = document.getElementById("container-campos");
                let novaLinha = container.firstElementChild.cloneNode(true); // Clona a primeira linha de campos
                container.appendChild(novaLinha); // Adiciona ao contêiner
            });
        </script>

    </form>
{{-- @endsection --}}
</x-app-layout>