<x-guest-wide-layout>

    <div class="w-full max-w-6xl mx-auto px-8 py-10 bg-white rounded-md ">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="text-center mb-8">
                <h2 class="text-lg font-semibold text-gray-800">Cadastrar</h2>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Usuário -->

                <div>
                    <x-input-label for="usuario" :value="__('Crie um Usuário:')" />
                    <x-text-input id="usuario" name="usuario" type="text" class="w-full" :value="old('usuario')"
                        required />

                    @error('usuario')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Nome -->
                <div>
                    <x-input-label for="nome" :value="__('Nome:')" />
                    <x-text-input id="nome" name="nome" type="text" class="w-full" :value="old('nome')" required />

                    @error('nome')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email:')" />
                    <x-text-input id="email" name="email" type="email" class="w-full" :value="old('email')" required />

                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Setor (Dropdown) -->
                <div>
                    <x-input-label for="setor" :value="__('Setor em que trabalha:')" />
                    <select id="setor" name="setor"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        required>
                        <option value="" disabled {{ old('setor') ? '' : 'selected' }}>Selecione um setor</option>
                        <option value="Registro" {{ old('setor') == 'Registro' ? 'selected' : '' }}>Registro</option>
                        <option value="Recepção" {{ old('setor') == 'Recepcao' ? 'selected' : '' }}>Recepção</option>
                        <option value="Financeiro" {{ old('setor') == 'Financeiro' ? 'selected' : '' }}>Financeiro
                        </option>
                        <option value="TI" {{ old('setor') == 'TI' ? 'selected' : '' }}>TI</option>
                    </select>

                    @error('setor')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Telefone -->
                <div>
                    <x-input-label for="telefone" :value="__('Telefone')" />
                    <x-text-input id="telefone" name="telefone" type="text" class="w-full" :value="old('telefone')"
                        required />

                    @error('telefone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Endereço -->
                <div>
                    <x-input-label for="endereco" :value="__('Endereço')" />
                    <x-text-input id="endereco" name="endereco" type="text" class="w-full" :value="old('endereco')"
                        required />

                    @error('endereco')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Senha -->
                <div class="relative">
                    <x-input-label for="password" :value="__('Senha')" />
                    <x-text-input id="password" name="password" type="password" class="w-full" required />
                    <div id="password-strength"></div>
                </div>

                <!-- Confirmar Senha -->
                <div class="relative">
                    <x-input-label for="password_confirmation" :value="__('Confirme a senha')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="w-full"
                        required />
                    <div id="password-match"></div>
                </div>

            </div>


            <!-- Botões -->
            <div class="flex justify-between items-center mt-8">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Já possui cadastro?') }}
                </a>

                <x-primary-button id="botao-cadastrar">
                    {{ __('Cadastrar') }}
                </x-primary-button>

            </div>
        </form>
    </div>
</x-guest-wide-layout>