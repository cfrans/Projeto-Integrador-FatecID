<x-app-layout>
    <style>
        .campo-formulario {
            border: 0px;
            padding: 8px;
        }

        select, input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc; /* Borda cinza */
            border-radius: 0.5rem;  /* Bordas arredondadas */
            font-size: 0.9rem;
            background-color: #f3f4f6; /* Cinza claro */
            color: #111827; /* Texto quase preto */
        }
    </style>

    <x-input-label for="pesquisa_protocolo" class="ml-16 mt-14">
        Pesquisa de Protocolo
    </x-input-label>

    <form action="#" method="GET">
        <div class="flex justify-start gap-4 w-[92%] mx-auto bg-white rounded-t-md">
            <div class="campo-formulario flex ml-6 items-center w-[13%]">
                <div class="text-left">
                    <x-input-label for="grupo">Grupo</x-input-label>
                    <x-input-select id="grupo" name="grupo" class="w-[200px] h-8 text-sm">
                        <option value="">Selecione</option>
                        <option value="TD">Títulos e Documentos</option>
                        <option value="PJ">Pessoa Jurídica</option>
                    </x-input-select>
                </div>
            </div>

            <div class="campo-formulario flex ml-6 items-center w-[13%]">
                <div class="text-left">
                    <x-input-label for="natureza">Natureza</x-input-label>
                    <x-text-input id="natureza" name="natureza" class="w-[200px] h-8 text-sm" />
                </div>
            </div>

            <div class="campo-formulario flex ml-6 items-center w-[13%]">
                <div class="text-left">
                    <x-input-label for="especie">Espécie</x-input-label>
                    <x-input-select id="especie" name="especie" class="w-[200px] h-8 text-sm">
                        <option value="">Selecione</option>
                        <option value="registro">Registro</option>
                        <option value="averbacao">Averbação</option>
                    </x-input-select>
                </div>
            </div>

            <div class="campo-formulario flex ml-6 items-center w-[13%]">
                <div class="text-left">
                    <x-input-label for="numero_registro">Número do Registro</x-input-label>
                    <x-text-input id="numero_registro" name="numero_registro" class="w-[200px] h-8 text-sm" />
                </div>
            </div>
        </div>

        <div class="flex justify-start gap-4 w-[92%] mx-auto bg-white rounded-b-md mt-4">
            <div class="campo-formulario flex ml-6 items-center w-[13%]">
                <div class="text-left">
                    <x-input-label for="documento">Documento</x-input-label>
                    <x-input-select id="documento" name="documento" class="w-[200px] h-8 text-sm">
                        <option value="">Selecione</option>
                        <option value="RG">RG</option>
                        <option value="CPF">CPF</option>
                    </x-input-select>
                </div>
            </div>

            <div class="campo-formulario flex ml-6 items-center w-[13%]">
                <div class="text-left">
                    <x-input-label for="numero_documento">Número do Documento</x-input-label>
                    <x-text-input id="numero_documento" name="numero_documento" class="w-[200px] h-8 text-sm" />
                </div>
            </div>

            <div class="campo-formulario flex ml-6 items-center w-[13%]">
                <div class="text-left">
                    <x-input-label for="nome">Nome</x-input-label>
                    <x-text-input id="nome" name="nome" class="w-[200px] h-8 text-sm" />
                </div>
            </div>

            <div class="campo-formulario flex ml-6 items-center w-[10%]">
                <button type="submit" class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded">
                    Pesquisar
                </button>
            </div>
        </div>
    </form>

    <x-input-label for="protocolos_encontrados" class="ml-16 mt-14">
        Protocolo(s) Encontrado(s)
    </x-input-label>

    <table class="w-[92%] mx-auto bg-white rounded-md" style="table-layout: fixed;">
    <thead>
        <tr class="border-b">
            <th class="px-4 py-2" style="width: 10%; text-align: center;">Protocolo</th>
            <th class="px-4 py-2" style="width: 15%; text-align: center;">Grupo</th>
            <th class="px-4 py-2" style="width: 25%; text-align: center;">Natureza</th>
            <th class="px-4 py-2" style="width: 25%; text-align: center;">Data do Protocolo</th>
            <th class="px-4 py-2" style="width: 25%; text-align: center;">Ação</th>
        </tr>
    </thead>
    <tbody>
        <tr class="border-b">
            <td class="px-4 py-2" style="text-align: center;">1</td>
            <td class="px-4 py-2" style="text-align: center;">TD</td>
            <td class="px-4 py-2" style="text-align: center;">Registro</td>
            <td class="px-4 py-2" style="text-align: center;">2025-05-21</td>
            <td class="px-4 py-2" style="text-align: center;">
                <a href="#">camila</a>
            </td>
        </tr>
    </tbody>
</table>

</x-app-layout>
