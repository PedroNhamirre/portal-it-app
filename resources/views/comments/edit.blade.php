<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-1">
            {{ __('Editar comentário') }}
        </h2>
    </x-slot>

    <div class="container mx-auto w-6/12 mt-4 p-8 bg-white rounded-lg shadow-lg">
        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h1 class="text-center text-4xl font-bold">Editar Comentário:</h1>

            <div class="mb-4">
                <label for="body" class="block mb-2 text-xl font-bold text-gray-900 uppercase ">Conteúdo</label>
                <textarea id="body" name="content" class="border p-2 w-full rounded-md resize-none">{{ $comment->content }}</textarea>
            </div>
            <button type="submit"
                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                Salvar alterações
            </button>
        </form>

    </div>
</x-app-layout>
