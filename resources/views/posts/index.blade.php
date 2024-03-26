<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-1">
            {{ __('Questões') }}
        </h2>

        <div>




            <x-primary-button class="ms-5"> <a href="{{ route('posts.create') }}" class="">
                    <i class="fa-solid fa-plus"></i> POSTAR
                </a></x-primary-button>
        </div>

    </x-slot>

    <div class="mt-3">
        <h1 class="text-center my-10 text-gray-800 text-4xl bg:text-white dark:text-white	">Pesquise por questões <i
                class="fa-solid fa-arrow-down"></i></h1>

        <div class="flex items-center justify-center w-auto mx-40">
            <form class="grow" action="{{ route('search') }}">
                <label for="default-search"
                    class="mb-2 text-base font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 pl-10 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Pesquise por Questões..." name="query" required>
                    <button type="submit"
                        class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pesquisar</button>
                </div>
            </form>
        </div>

        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <div class="container mx-auto mt-5">
                    @if ($post->cover_image !== 'no-image.jpg')
                        <div
                            class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-full w-10/12 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 mx-auto">
                            <img class="object-cover w-full rounded-t-lg h-96 ms-2 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                                src="/storage/cover_images/{{ $post->cover_image }}" alt="">
                            <div class="flex w-10/12  flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                    onclick="window.location.href='{{ route('posts.show', ['id' => $post->id]) }}'">
                                    {{ $post->title }}
                                </h5>
                                <a href="{{ route('posts.show', ['id' => $post->id]) }}"
                                    class="mb-3 text-wrap font-normal text-gray-700 dark:text-gray-400"
                                    style="max-width: 100%; overflow: hidden; display: block; white-space: nowrap; text-overflow: ellipsis;">
                                    {!! Str::limit(strip_tags($post->body, '<a>'), 600) !!}
                                </a>
                                <a href="{{ route('posts.show', ['id' => $post->id]) }}"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5 w-24">
                                    Ler Mais
                                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>

                                <div class="flex  justify-between pt-4 px-4 leading-normal">
                                    <div class="text-gray-500text-lg">
                                        <i class="fa-regular fa-eye"></i> {{ $post->view_count }}
                                    </div>

                                    <div class="text-gray-500 dark:text-white  text-lg">
                                        <i class="fa-regular fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                                    </div>

                                    @if ($post->id_user === Auth::id())
                                        <button id="dropdownMenuIconHorizontalButton"
                                            data-dropdown-toggle="dropdownDotsHorizontal{{ $post->id }}"
                                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 16 3">
                                                <path
                                                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div id="dropdownDotsHorizontal{{ $post->id }}"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="dropdownMenuIconHorizontalButton">
                                                <li class="mt-2">
                                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-12 py-2.5 mr-2 text-center w-full	ms-4   dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('posts.destroy', ['id' => $post->id]) }}"
                                                        method="POST" class="float-right">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-danger-button class="me-3 my-3   ">
                                                            {{ __('Apagar Postagem') }}
                                                        </x-danger-button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        @foreach ($users as $user)
                                            @if ($user->id === $post->id_user)
                                                <div class="text-gray-500 text-lg" style="margin-bottom: -0.25rem;">
                                                    <p class="flex items-end">
                                                        owner
                                                        <span class="ms-1 font-bold text-xl">
                                                            <span class="text-sm">
                                                                <i class="fa-solid fa-at"></i>
                                                            </span>{{ $user->name }}
                                                        </span>
                                                    </p>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                            </div>

                        </div>
                    @else
                        <div
                            class="w-10/12 mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $post->title }}</h5>
                            </a>
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}"
                                class="mb-3 text-wrap font-normal text-gray-700 dark:text-gray-400"
                                style="max-width: 100%; overflow: hidden; display: block; white-space: nowrap; text-overflow: ellipsis;">
                                {!! Str::limit(strip_tags($post->body, '<a>'), 600) !!}
                            </a>
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">
                                Ler Mais
                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                            <div class="flex  justify-between pt-4 px-4 leading-normal">
                                <div class="text-gray-500text-lg">
                                    <i class="fa-regular fa-eye"></i> {{ $post->view_count }}
                                </div>

                                <div class="text-gray-500  text-lg">
                                    <i class="fa-regular fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                                </div>

                                @if ($post->id_user === Auth::id())
                                    <button id="dropdownMenuIconHorizontalButton"
                                        data-dropdown-toggle="dropdownDotsHorizontal"
                                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 16 3">
                                            <path
                                                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div id="dropdownDotsHorizontal"
                                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownMenuIconHorizontalButton">
                                            <li class="mt-2">
                                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-12 py-2.5 mr-2 text-center w-full	ms-4   dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('posts.destroy', ['id' => $post->id]) }}"
                                                    method="POST" class="float-right">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-danger-button class="me-3 my-3   ">
                                                        {{ __('Apagar Postagem') }}
                                                    </x-danger-button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    @foreach ($users as $user)
                                        @if ($user->id === $post->id_user)
                                            <div class="text-gray-500 text-lg" style="margin-bottom: -0.25rem;">
                                                <p class="flex items-end">
                                                    owner
                                                    <span class="ms-1 font-bold text-xl">
                                                        <span class="text-sm">
                                                            <i class="fa-solid fa-at"></i>
                                                        </span>{{ $user->name }}
                                                    </span>
                                                </p>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    @endif
                </div>
            @endforeach


            <div class="flex justify-center mt-3">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center mt-16">
                <h1 class="text-red-500 text-2xl">
                    <i class="fa-solid fa-face-sad-tear"></i> Sem posts no momento!
                </h1>
            </div>
        @endif

    </div>




    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

</x-app-layout>
