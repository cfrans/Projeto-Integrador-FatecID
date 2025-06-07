<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 ">
        {{ __('Esqueceu sua senha? Sem problemas, informe seu e-mail e enviaremos o link para redefinição') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class = "mb-8">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 mb-4" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button>
                {{ __('Enviar link para redefinir senha') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
