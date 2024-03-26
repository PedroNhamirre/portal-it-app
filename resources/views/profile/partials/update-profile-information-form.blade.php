<section>
    @if (session('status') === 'profile-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
            {{ __('Saved.') }}</p>
    @endif
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="ocupacao" :value="__('Ocupação')" />
            <x-text-input id="ocupacao" name="ocupacao" type="text" class="mt-1 block w-full" :value="old('ocupacao', $user->ocupacao)" />
            <x-input-error class="mt-2" :messages="$errors->get('ocupacao')" />
        </div>

        <div>
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input id="telefone" name="telefone" type="text" class="mt-1 block w-full" :value="old('telefone', $user->telefone)" />
            <x-input-error class="mt-2" :messages="$errors->get('telefone')" />
        </div>

        <div>
            <x-input-label for="ano_frequencia" :value="__('Ano de Frequência')" />
            <x-text-input id="ano_frequencia" name="ano_frequencia" type="text" class="mt-1 block w-full"
                :value="old('ano_frequencia', $user->ano_frequencia)" />
            <x-input-error class="mt-2" :messages="$errors->get('ano_frequencia')" />
        </div>

        <div>
            <x-input-label for="nacionalidade" :value="__('Nacionalidade')" />
            <select id="nacionalidade" name="nacionalidade"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                required>
                <option value="" disabled selected>{{ __('Selecione a nacionalidade') }}</option>
                @foreach ($paises as $codigo => $pais)
                    <option value="{{ $codigo }}"
                        {{ old('nacionalidade', $user->nacionalidade) == $codigo ? 'selected' : '' }}>
                        {{ $pais }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('nacionalidade')" />
        </div>

        <div>
            <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" />

            <input type="date" name="data_nascimento"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                value="{{ $user->data_nascimento }}">

            <x-input-error class="mt-2" :messages="$errors->get('data_nascimento')" />
        </div>

        <div>
            <div class="col-span-full">
                <x-input-label for="profile_image" :value="__('Foto do perfil')" />

                <div class="mt-2 flex items-center gap-x-3">
                    @if ($user->profile_image !== null || $user->profile_image === 'no-image.jpg')
                        <!-- Exibição da imagem do perfil do usuário -->
                        <img id="preview-image"
                            src="{{ asset('storage/profile_images/' . Auth::user()->profile_image) }}"
                            alt="Foto do perfil" class="h-12 w-12 rounded-full" />
                    @else
                        <img id="preview-image" src="https://www.w3schools.com/howto/img_avatar.png"
                            alt="Foto do perfil" class="h-12 w-12 rounded-full" />
                    @endif
                    <!-- Campo de entrada de arquivo oculto -->
                    <input type="file" id="profile_image" name="profile_image"
                        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                        onchange="previewImage(event)" />
                </div>


                <div class="mb-4">
                    <x-input-label class="mt-2" for="about" :value="__('Sobre ti')" />

                    <textarea id="about" name="about" class="border p-2 w-full rounded-md resize-none">{{ $user->about }}</textarea>
                </div>

                <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
            </div>

            <div class="flex items-center gap-4 mt-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
        </div>
    </form>
</section>
