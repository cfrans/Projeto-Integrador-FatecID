@vite(['resources/css/app.css', 'resources/js/app.js'])

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">
            {{ __('Índices') }}
        </h2>
    </x-slot>

    <div class="bg-gray-100 min-h-screen">
        <main class="w-full px-8">


            <div class="bg-gray-100 p-6 rounded-md">
                <x-input-label for="pesquisa_protocolo" class="ml-0 mb-0 block text-lg font-semibold">
                    Pesquisa de Protocolo
                </x-input-label>

                <div class="bg-white rounded-md">
                    <form action="#" method="GET">
                        <div class="flex flex-wrap gap-4 p-4">
                            <div class="campo-formulario flex flex-col w-[200px]">
                                <x-input-label for="grupo">Grupo</x-input-label>
                                <x-input-select id="grupo" name="grupo" class="w-full h-8 text-sm">
                                    <option value="">Selecione</option>
                                    <option value="TD">Títulos e Documentos</option>
                                    <option value="PJ">Pessoa Jurídica</option>
                                </x-input-select>
                            </div>

                            <div class="campo-formulario flex flex-col w-[600px]">
                                <x-input-label for="natureza">Natureza</x-input-label>
                                <x-text-input id="natureza" name="natureza" class="w-full h-8 text-sm" />
                            </div>

                            <div class="campo-formulario flex flex-col w-[200px]">
                                <x-input-label for="especie">Espécie</x-input-label>
                                <x-input-select id="especie" name="especie" class="w-full h-8 text-sm">
                                    <option value="">Selecione</option>
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
                                    <option value="">Selecione</option>
                                    <option value="RG">RG</option>
                                    <option value="CPF">CPF</option>
                                </x-input-select>
                            </div>

                            <div class="campo-formulario flex flex-col w-[200px]">
                                <x-input-label for="numero_documento">Número do Documento</x-input-label>
                                <x-text-input id="numero_documento" name="numero_documento" class="w-full h-8 text-sm" />
                            </div>

                            <div class="campo-formulario flex flex-col w-[770px]">
                                <x-input-label for="nome">Nome</x-input-label>
                                <x-text-input id="nome" name="nome" class="w-full h-8 text-sm" />
                            </div>

                            <div class="campo-formulario flex flex-col w-[50px] self-end">
                                <button type="submit" aria-label="Pesquisar" 
                                    class="bg-gray-300 hover:bg-gray-400 text-black font-bold h-8 w-8 flex items-center justify-center border border-gray-300 rounded-md">
                                    🔍
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-gray-100 p-6 mt-0 rounded-md">
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
            </div>

        </main>
    </div>

</x-app-layout>
