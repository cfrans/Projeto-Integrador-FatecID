{{-- resources/views/protocolos/index.blade.php --}}
<x-app-layout>
{{-- @section('header', 'Cadastro de Protocolo')

@section('title', 'Protocolos')

@section('content') --}}
    {{-- Estilo temporario para ajudar a ver as divisoes --}}
    <style>
        .campo-formulario {
            border: 1px solid #ccc;
            padding: 8px;
        }
    </style>

    {{-- TODO: Criar o endpoint para o formulario --}}
    <form action="/endpoint" method="post">

        <h2>Dados do Protocolo</h2>

        {{-- DIV MENOR PARA O CONTEUDO DOS CAMPOS --}}
        <div style="display: flex; width: 80%; margin: auto;">

            <!-- Primeira coluna (2/7) -->
            <div class="campo-formulario" style="flex: 2;">
                <label for="protocolo_grupo">Grupo</label><br>
                <select id="protocolo_grupo" name="protocolo_grupo" required>
                    <option value="protocolo_grupo_td">Títulos e Documentos</option>
                    <option value="protocolo_grupo_pj">Pessoa Jurídica</option>
                </select>
            </div>

            <!-- Segunda coluna (2/7) -->
            <div class="campo-formulario" style="flex: 2;">
                <label for="protocolo_natureza">Natureza</label><br>
                <select id="protocolo_natureza" name="protocolo_natureza" required>
                    <option value="protocolo_natureza_01">Natureza 01</option>
                    <option value="protocolo_natureza_02">Natureza 02</option>
                    {{-- TODO: Confirmar os tipos de natureza --}}
                </select>
            </div>

            <!-- Terceira coluna (2/7) -->
            <div class="campo-formulario" style="flex: 2;">
                <label for="protocolo_especie">Espécie</label><br>
                <select id="protocolo_especie" name="protocolo_especie" required>
                    <option value="protocolo_especie_registro">Registro</option>
                    <option value="protocolo_especie_averbacao">Averbação</option>
                </select>
            </div>

            <!-- Quarta coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="protocolo_data">Data</label><br>
                <input type="date" id="protocolo_data" name="protocolo_data" required>
                {{-- TODO: Confirmar o formato da data e se vai ser editável --}}
            </div>

        </div>

        <div style="display: flex; width: 80%; margin: auto;">
            <!-- Primeira coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="protocolo_numero_documento">Nº Documento / Título</label><br>
                <input type="text" id="protocolo_numero_documento" name="protocolo_numero_documento" required>
            </div>

            <!-- Segunda coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="protocolo_data_documento">Data do documento</label><br>
                <input type="date" id="protocolo_data_documento" name="protocolo_data_documento" required>
            </div>

            <!-- Terceira coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="protocolo_numero_protocolo">Protocolo</label><br>
                <input type="text" id="protocolo_numero_protocolo" name="protocolo_numero_protocolo" required>
                {{-- TODO: Confirmar se esse é o numero do protocolo mesmo que vai ser gerado sozinho --}}
            </div>

            <!-- Quarta coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="protocolo_previsao">Previsão</label><br>
                <input type="date" id="protocolo_previsao" name="protocolo_previsao" required>
                {{-- TODO: Confirmar se tambem é editável ou só calcular o prazo a partir da data inicial --}}
            </div>

            <!-- Quinta coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="protocolo_cancelamento">Cancelamento</label><br>
                <input type="text" id="protocolo_cancelamento" name="protocolo_cancelamento" required>
            </div>

            <!-- Sexta coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="protocolo_data_registro">Data de registro</label><br>
                <input type="date" id="protocolo_data_registro" name="protocolo_data_registro" required>
            </div>

            <!-- Sétima coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="protocolo_data_de_retirada">Data de Retirada</label><br>
                <input type="date" id="protocolo_data_de_retirada" name="protocolo_data_de_retirada" required>
            </div>
        </div>

        <h2>Dados do Apresentante</h2>

        <div style="display: flex; width: 80%; margin: auto;">
            <!-- Primeira coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="apresentante_documento">Documento</label><br>
                <select id="apresentante_documento" name="apresentante_documento" required>
                    <option value="apresentante_documento_rg">RG</option>
                    <option value="apresentante_documento_cpf">CPF</option>
                    <option value="apresentante_documento_cnh">CNH</option>
                </select>
            </div>

            <!-- Segunda coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="apresentante_numero_documento">Número do Documento</label><br>
                <input type="text" id="apresentante_numero_documento" name="apresentante_numero_documento" required>
            </div>

            <!-- Terceira coluna (3/7) -->
            <div class="campo-formulario" style="flex: 3;">
                <label for="apresentante_nome">Nome</label><br>
                <input type="text" id="apresentante_nome" name="apresentante_nome" required>
            </div>
        </div>

        <div style="display: flex; width: 80%; margin: auto;">
            <!-- Primeira coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="apresentante_tipo_contato">Tipo de Contato</label><br>
                <input type="text" id="apresentante_tipo_contato" name="apresentante_tipo_contato" required>
            </div>

            <!-- Segunda coluna (1/7) -->
            <div class="campo-formulario" style="flex: 1;">
                <label for="apresentante_numero_contato">Número de Contato</label><br>
                <input type="text" id="apresentante_numero_contato" name="apresentante_numero_contato" required>
            </div>

            <!-- Terceira coluna (5/7) -->
            <div class="campo-formulario" style="flex: 3;">
                <label for="apresentante_email">E-mail</label><br>
                <input type="email" id="apresentante_email" name="apresentante_email" required>
            </div>
        </div>

        <h2>Dados das Partes</h2>

        <div style="width: 80%; margin: auto;">

            <div id="container-campos">
                <div style="display: flex; gap: 10px;" class="linha-campo">
                    <!-- Primeira coluna (1/7) -->
                    <div class="campo-formulario" style="flex: 1;">
                        <label for="parte_tipo">Tipo</label><br>
                        <select name="parte_tipo[]" required>
                            <option value="fisica">Física</option>
                            <option value="juridica">Jurídica</option>
                        </select>
                    </div>
                    <!-- Segunda coluna (3/7) -->
                    <div class="campo-formulario" style="flex: 3;">
                        <label for="parte_nome">Nome / Razão Social</label><br>
                        <input type="text" name="parte_nome[]" required>
                    </div>
                </div>
            </div>

            <!-- Botão de adicionar nova linha -->
            <button type="button" id="parte_adicionar">+</button>

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