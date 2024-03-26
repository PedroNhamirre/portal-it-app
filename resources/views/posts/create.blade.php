<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Criar Questão') }}
        </h2>
    </x-slot>


    <div class="container mx-auto w-6/12 mt-4 p-8 bg-white rounded-lg shadow-lg">
        <div class="mt-6">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="title" class="block mb-2 text-xl font-bold text-gray-900 uppercase ">Título</label>
                    <input type="text" id="title" name="title"
                        class="bg-white border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Título">
                </div>
                <div>
                    <label for="body" class="block mb-2 text-xl font-bold text-gray-900 uppercase ">Conteúdo</label>
                    <textarea id="body" name="body"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        style="resize:none" placeholder="Digite aqui o conteúdo..."></textarea>
                </div>
                <div>
                    <label class="block mb-2 mt-4 text-xl font-bold text-gray-900 uppercase " for="file_input">Upload
                        file</label>
                    <div id="drop-area"
                        class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <img id="preview-image" class="mx-auto h-12 w-12 text-gray-300"
                                src="{{ asset('storage/cover_images/image_icon.png') }}" alt="Current Image">
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
        tinymce.init({
            selector: 'textarea', // CSS selector for your textarea
            plugins: 'powerpaste casechange searchreplace autolink directionality advcode visualblocks visualchars link codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker help formatpainter permanentpen charmap linkchecker emoticons advtable export autosave',
            toolbar: 'undo redo formatpainter | visualblocks | alignleft aligncenter alignright alignjustify | blocks fontfamily fontsize | bold italic underline forecolor backcolor | lineheight | removeformat',
            height: '300px',

        });
    </script>

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
