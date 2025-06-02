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
                    <x-text-input id="usuario" name="usuario" type="text" class="w-full" :value="old('usuario')" required />
                </div>

                <!-- Nome -->
                <div>
                    <x-input-label for="nome" :value="__('Nome:')" />
                    <x-text-input id="nome" name="nome" type="text" class="w-full" :value="old('nome')" required />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email:')" />
                    <x-text-input id="email" name="email" type="email" class="w-full" :value="old('email')" required />
                </div>

                <!-- Setor -->
                <div>
                    <x-input-label for="setor" :value="__('Setor em que trabalha:')" />
                    <x-text-input id="setor" name="setor" type="text" class="w-full" :value="old('setor')" required />
                </div>

                <!-- Telefone -->
                <div>
                    <x-input-label for="telefone" :value="__('Telefone')" />
                    <x-text-input id="telefone" name="telefone" type="text" class="w-full" :value="old('telefone')" required />
                </div>

                <!-- Endereço -->
                <div>
                    <x-input-label for="endereco" :value="__('Endereço')" />
                    <x-text-input id="endereco" name="endereco" type="text" class="w-full" :value="old('endereco')" required />
                </div>

                <!-- Senha -->
                <div>
                    <x-input-label for="password" :value="__('Senha')" />
                    <x-text-input id="password" name="password" type="password" class="w-full" required />
                </div>

                <!-- Confirmar Senha -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirme a senha')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="w-full" required />
                </div>
            </div>

            <!-- Botões -->
            <div class="flex justify-between items-center mt-8">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Já possui cadastro?') }}
                </a>

                <x-primary-button>
                    {{ __('Cadastrar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-wide-layout>