<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-1">
            {{ __('Editar Questão') }}
        </h2>

        <a href="{{ route('posts.index') }}"
            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200  rounded-lg text-sm  ms-20 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 uppercase p-2 font-bold"><i
                class="fa-solid fa-arrow-left"></i> VER Questões</a>
    </x-slot>

    <div class="container mx-auto w-6/12 mt-4 p-8 bg-white rounded-lg shadow-lg">

        <h1 class="text-3xl font-bold text-center mb-6">Editar Questão</h1>

        <div class=" mx-auto">
            <form action="{{ route('posts.update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block mb-2 text-xl font-bold text-gray-900uppercase ">Título</label>
                    <input type="text" id="title" name="title" value="{{ $post->title }}"
                        class="border p-2 w-full rounded-md">
                </div>

                <div class="mb-4">
                    <label for="body" class="block mb-2 text-xl font-bold text-gray-900 uppercase ">Conteúdo</label>
                    <textarea id="body" name="body" class="border p-2 w-full rounded-md resize-none">{{ $post->body }}</textarea>
                </div>

                <div>
                    <label class="block mb-2 mt-4 text-xl font-bold text-gray-900 uppercase " for="file_input">Upload
                        file</label>
                    <div id="drop-area"
                        class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <img id="preview-image" class="mx-auto h-12 w-12 text-gray-300"
                                src="{{ asset('storage/cover_images/' . $post->cover_image) }}" alt="Current Image">
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="file-upload"
                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>Upload a file or drop here</span>
                                    <input id="file-upload" name="cover_image" type="file" class="sr-only">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit"
                            class=" mt-2 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
                    </div>
            </form>
            <form action="{{ route('posts.index') }}" method="GET">
                <button type="submit" class="text-base font-semibold leading-6 text-gray-900">Cancelar</button>
            </form>
        </div>
    </div>




    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('file-upload');
        const previewImage = document.getElementById('preview-image');

        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add(
            'bg-gray-100'); // Adicione uma classe de destaque quando o arquivo é arrastado sobre a área de drop
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove(
            'bg-gray-100'); // Remova a classe de destaque quando o arquivo deixa a área de drop
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('bg-gray-100'); // Remova a classe de destaque quando o arquivo é solto

            const file = event.dataTransfer.files[0];
            const reader = new FileReader();

            reader.onloadend = () => {
                previewImage.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
                fileInput.files = event.dataTransfer
                .files; // Atualize os arquivos no input de arquivo com os arquivos soltos
            }
        });

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onloadend = () => {
                previewImage.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>


</x-app-layout>
