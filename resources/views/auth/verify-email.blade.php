<x-guest-layout>
    <div class="mb-4 text-lg text-gray-600 dark:text-gray-400 font-serif text-justify">
        <span class="text-blue-500 text-2xl font-bold ">{{ __('Obrigado por se cadastrar!') }}</span> Antes de começar,
        você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não
        recebeu o
        e-mail, ficaremos felizes em enviar outro.
    </div>


    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex flex-col	gap-5  items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
