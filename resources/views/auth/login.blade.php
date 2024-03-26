<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                placeholder="nome@companhia.com" autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" placeholder="••••••••" type="password"
                name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex mt-4 justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 mt-2"
                    name="remember">
                <span class="ml-2 text-lg mt-2 text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>


            @if (Route::has('password.request'))
                <a class="text-lg font-medium text-blue-600 hover:underline dark:text-primary-500 mt-2"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="mt-2 w-full bg-blue-600">
                <span class="ms-36 text-xl">
                    {{ __('Log in') }}
                </span>
            </x-primary-button>
        </div>

        <p class="text-lg mt-4 font-light text-gray-500 dark:text-gray-400">
            Não tens uma conta? <a href="register"
                class="font-medium text-blue-600  hover:underline dark:text-primary-500">Criar conta</a>
        </p>
    </form>
</x-guest-layout>
