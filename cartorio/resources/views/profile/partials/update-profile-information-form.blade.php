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

        <div>
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" :value="old('nome', $user->nome)" required autofocus autocomplete="nome" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
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
                autocomplete="tel" />
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
                autocomplete="street-address" />
            <x-input-error class="mt-2" :messages="$errors->get('endereco')" />
        </div>

        <!-- Setor (Dropdown) -->
        @php
        $setoresFixos = ['Registro', 'Recepção', 'Financeiro', 'TI'];
        $setorAtual = old('setor', $user->setor ?? '');
        @endphp

        <div>
            <x-input-label for="setor" :value="__('Setor')" />
            <select id="setor" name="setor"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required>

                <option value="" disabled {{ $setorAtual === '' ? 'selected' : '' }}>Selecione um setor</option>

                {{-- Se for um valor fora da lista, exibe como opção adicional no topo --}}
                @if ($setorAtual && !in_array($setorAtual, $setoresFixos))
                <option value="{{ $setorAtual }}" selected>{{ $setorAtual }} (atual)</option>
                @endif

                {{-- Lista fixa --}}
                @foreach ($setoresFixos as $setor)
                <option value="{{ $setor }}" {{ $setorAtual === $setor ? 'selected' : '' }}>{{ $setor }}</option>
                @endforeach
            </select>

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
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Salvo.') }}</p>
            @endif
        </div>
    </form>
</section>