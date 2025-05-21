<x-app-layout>
    <style>
        .campo-formulario {
            border: 0px;
            padding: 8px;
        }
    </style>

    <x-input-label for="pesquisa_protocolo" class="ml-16 mt-14">
        Pesquisa de Protocolo
    </x-input-label>

    <form action="#" method="GET">
        <div class="flex justify-center gap-4 w-[92%] mx-auto bg-white rounded-t-md">

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

        <div class="flex justify-center gap-4 w-[92%] mx-auto bg-white rounded-b-md mt-4">

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
                    🔍
                </button>
            </div>
        </div>
    </form>

    <x-input-label for="protocolos_encontrados" class="ml-16 mt-14">
        Protocolo(s) Encontrado(s)
    </x-input-label>

    <table class="w-[92%] mx-auto bg-white rounded-md">
        <thead>
            <tr class="border-b">
                <th class="px-4 py-2">Protocolo</th>
                <th class="px-4 py-2">Grupo</th>
                <th class="px-4 py-2">Natureza</th>
                <th class="px-4 py-2">Data do Protocolo</th>
                <th class="px-4 py-2">Ação</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="px-4 py-2">1</td>
                <td class="px-4 py-2">TD</td>
                <td class="px-4 py-2">Registro</td>
                <td class="px-4 py-2">2025-05-21</td>
                <td class="px-4 py-2">
                    <a href="#">camila</a>
                </td>
            </tr>
        </tbody>
    </table>
</x-app-layout>
