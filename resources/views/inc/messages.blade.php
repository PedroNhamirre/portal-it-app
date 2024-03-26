@if (count($errors) > 0)

    @foreach ($errors->all() as $error)
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
            class="p-4 mb-4 text-lg text-center text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-bold">Erro!</span>{{ $error }} .
        </div>
    @endforeach
@endif

@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
        class="p-4 mb-4 text-lg text-center text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        <span class="font-bold">Successo!</span> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
        class="p-4 mb-4 text-lg text-center text-red-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-bold">Erro!</span> {{ session('success') }}
    </div>
@endif
