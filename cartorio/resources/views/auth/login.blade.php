<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="flex justify-center mb-2">
            <a class="font-extrabold text-lg font-sans">LOGIN</a>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="rounded bg-[#dedddd] border-[#dedddd] dark:bg-[#dedddd] dark:border-[#dedddd] text-gray-600 shadow-sm focus:ring-0 dark:focus:ring-0" />
                <span class="ms-2 text-sm text-[#696666] ">{{ __('Manter-me Logado') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4 w-full">
            <div>
                @if (Route::has('password.request'))
                <a class="underline text-sm text-[#696666] dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Esqueceu a senha?') }}
                </a>
                @endif
            </div>

<a href="{{ route('register') }}?email={{ request()->input('email', old('email')) }}" class="text-sm px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
    {{ __('Registrar') }}
</a>



                <x-primary-button class="bg-[#C27C5D] text-white hover:bg-[#A56048]">
                    {{ __('ENTRAR') }}
                </x-primary-button>
            </div>
        </div>
        </div>
    </form>
</x-guest-layout>