<x-app-layout>
    <x-slot name="title">Sobre</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-base text-white leading-tight">
            {{ __('Sobre') }}
        </h2>
    </x-slot>

    <div class="max-w-[75%] mx-auto w-full px-4">

        <section class="bg-white text-gray-800 px-6 py-4 rounded-xl shadow-lg max-w-3xl mx-auto mt-4">
            
            <h2 class="text-xl font-semibold text-gray-800 border-b-2 inline-block pb-1 mb-6" style="border-color: #b46a4a;">
                O Projeto
            </h2>

            <p class="mb-4 leading-relaxed text-base text-justify">
                Este sistema faz parte do <strong>Projeto Integrador (PI)</strong> do 2º semestre do curso de <strong>Análise e Desenvolvimento de Sistemas</strong> da <strong>Fatec Indaiatuba – Dr. Archimedes Lammoglia</strong>.
            </p>

            <p class="mb-4 leading-relaxed text-base text-justify">
                Desenvolvemos uma solução funcional para modernizar as atividades de um cartório de <strong>Títulos, Documentos e Pessoas Jurídicas</strong>, com base em entrevistas reais, levantamento de requisitos e aplicação prática dos conteúdos de <strong>Engenharia de Software I</strong> e <strong>Sistemas de Informação</strong>.
            </p>

            <div class="text-left">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Objetivos:</h3>
                <ul class="list-disc list-inside text-sm mb-4">
                    <li>Executar operações básicas de <strong>CRUD</strong>;</li>
                    <li>Organizar protocolos, apresentantes, documentos e autenticações;</li>
                    <li>Facilitar acesso, rastreabilidade e integridade das informações; e</li>
                    <li>Melhorar <strong>usabilidade</strong>, segurança e eficiência.</li>
                </ul>

                <h3 class="text-lg font-semibold text-gray-800 mb-2">Tecnologias e Metodologia:</h3>
                <ul class="list-disc list-inside text-sm mb-4">
                    <li>Framework <strong>Laravel</strong> com padrão <strong>MVC</strong>;</li>
                    <li>Modelagem com <strong>DER</strong> e estimativa com Function Points;</li>
                    <li>Aplicativo desenvolvido com base no ciclo <strong>PDCA</strong>; e</li>
                    <li>Práticas de versionamento, componentização e testes manuais.</li>
                </ul>
            </div>

            <p class="mb-4 leading-relaxed text-base text-justify">
                O sistema já conta com login seguro, módulos de consulta, cadastro e gestão de protocolos, e está preparado para expansão com funcionalidades como relatórios e assinatura digital.
            </p>

            <div class="mt-8 pt-4 border-t border-gray-200 text-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Acesse o Código-Fonte no GitHub</h3>
                <a href="https://github.com/cfrans/Projeto-Integrador-FatecID" target="_blank" rel="noopener noreferrer"
                   class="-mt-3 inline-flex  items-center px-6 py-3 bg-[#C27C5D] text-white font-bold rounded-lg shadow-md
                          hover:bg-[#D48F70]">
                    <img src="{{ asset('images/github.png') }}" alt="GitHub Logo" class="w-6 h-6 mr-3">
                    Repositório do Projeto
                </a>
                <p class="text-xs text-gray-500 mt-2">Conheça os desenvolvedores e o código do projeto!</p>
            </div>

        </section>
        
    </div>
</x-app-layout>