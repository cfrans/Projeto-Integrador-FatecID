<section>
    <header>
        <h2 class="text-lg font-medium text-[#484747] ">
            {{ __('Informações Pessoais') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Atualize as informações do seu perfil e seu e-mail.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Foto -->
        <div>
            <x-input-label for="foto" :value="__('Foto')" />
            <input
                id="foto"
                name="foto"
                type="file"
                accept="image/*"
                class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-[#ede3de] file:text-[#9D6954]
                    hover:file:bg-[#dcc6bc]
                    "
            />
            <x-input-error class="mt-2" :messages="$errors->get('foto')" />
        </div>


        <div>
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" :value="old('nome', $user->nome)" required autofocus autocomplete="nome" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Seu endereço não foi verificado.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Clique aqui para reenviar a verificação de e-mail.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Um novo link de verificação foi enviado para o seu e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Telefone -->
        <div>
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input
                id="telefone"
                name="telefone"
                type="tel"
                class="mt-1 block w-full"
                :value="old('telefone', $user->telefone ?? '')"
                required
                autofocus
                autocomplete="tel"
                pattern="^\+?\d{10,15}$"
                title="Informe um telefone válido, com 10 a 15 dígitos, opcionalmente iniciando com +"
            />
            <x-input-error class="mt-2" :messages="$errors->get('telefone')" />
        </div>

        <!-- Endereço -->
        <div>
            <x-input-label for="endereco" :value="__('Endereço')" />
            <x-text-input
                id="endereco"
                name="endereco"
                type="text"
                class="mt-1 block w-full"
                :value="old('endereco', $user->endereco ?? '')"
                required
                autocomplete="street-address"
            />
            <x-input-error class="mt-2" :messages="$errors->get('endereco')" />
        </div>

        <!-- Setor -->
        <div>
            <x-input-label for="setor" :value="__('Setor')" />
            <x-text-input
                id="setor"
                name="setor"
                type="text"
                class="mt-1 block w-full"
                :value="old('setor', $user->setor ?? '')"
                required
                autocomplete="organization"
            />
            <x-input-error class="mt-2" :messages="$errors->get('setor')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Salvo.') }}</p>
            @endif
        </div>
    </form>
</section>
