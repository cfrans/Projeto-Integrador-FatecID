<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="flex justify-center mb-2">
                    <a class="font-extrabold text-lg font-sans">Cadastrar</a>
        </div>

        <!-- Usuario -->
        <div class="mt-4">
            <x-input-label for="usuario" :value="__('Crie um Usuário:')" />
            <x-text-input id="usuario" class="block mt-1 w-full" type="text" name="usuario" :value="old('usuario')" required autocomplete="usuario" />
            <x-input-error :messages="$errors->get('usuario')" class="mt-2" /> <br>
        </div>

        <!-- NOME -->
        <div>
            <x-input-label for="nome" :value="__('Nome:')" />
            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus autocomplete="nome" />
            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email:')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$email ?? old('email')" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <!-- Setor -->
        <div class="mt-4">
            <x-input-label for="setor" :value="__('Setor em que trabalha:')" />
            <x-text-input id="setor" class="block mt-1 w-full" type="text" name="setor" :value="old('setor')" required autocomplete="setor" />
            <x-input-error :messages="$errors->get('setor')" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="mt-4">
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" :value="old('telefone')" required autocomplete="telefone" />
            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
        </div>

        <!-- Endereço -->
        <div class="mt-4">
            <x-input-label for="endereco" :value="__('Endereço')" />
            <x-text-input id="endereco" class="block mt-1 w-full" type="text" name="endereco" :value="old('endereco')" required autocomplete="street-address" />
            <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
        </div>





        <!-- SETOR (Confirmar com @Vitoria)
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>  -->

        <!-- SENHA -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- CONFIRMAR SENHA -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirme a senha')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Já possui cadastro?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Cadastrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
