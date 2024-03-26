<div class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
            <div class="col-span-4 sm:col-span-3">
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex flex-col items-center">

                        @if ($user->profile_image && $user->profile_image !== 'no-image.jpg')
                            <img src="/storage/profile_images/{{ $user->profile_image }}"
                                class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">
                        @else
                            <img src="https://www.w3schools.com/howto/img_avatar.png"
                                class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">
                        @endif


                        <h1 class="text-xl font-bold">{{ $user->name }}</h1>
                        <p class="text-gray-600"> {{ $user->ocupacao }} </p>
                    </div>
                    <hr class="my-6 border-t border-gray-300">
                    <div class="flex flex-col text-center">
                        <span class="text-gray-600 uppercase font-bold tracking-wider mb-2">Info    </span>
                        <ul>
                            <li class="mb-2">E-mail: {{$user->email}}</li>
                            <li class="mb-2">
                                Nacionalidade: {{$user->nacionalidade}} 
                            </li>
                            <li class="mb-2">Telefone: {{$user->telefone}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-span-4 sm:col-span-9">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-4xl font-bold mb-4 text-center">Sobre</h2>
                    <p class="text-gray-700"> {!! $user->about !!}
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
