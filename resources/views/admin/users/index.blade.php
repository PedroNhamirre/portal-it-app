<x-app-layout>
    <x-slot name="header">
        @if (Auth::user()->role === 'admin')
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex uppercase font-semibold">
                <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                    {{ __('dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                    {{ __('Usuários') }}
                </x-nav-link>
               
            </div>
        @endif
    </x-slot>


    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-2 mt-2">Painel de Usuários</h1>



        <div class="bg-white shadow-md rounded my-3">
            <table class="text-left w-full border-collapse">
                <thead>
                    <tr>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            Name</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            Email</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            Role</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">{{ $user->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $user->email }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $user->role }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                @if (Auth::user()->role === 'admin')
                                    @if (Auth::user()->email === 'admin@admin.com')
                                        <a href="#" class="text-blue-500 hover:text-blue-700 underline">Edit</a>
                                    @endif
                                    @if ($user->role === 'user')
                                        @if (Auth::user()->email !== 'admin@admin.com')
                                            <a href="#"
                                                class="text-blue-500 hover:text-blue-700 underline mr-5">Edit</a>
                                        @endif
                                        
                                        <form action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500 hover:text-red-700 underline ml-5">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                @endif


                                @if (Auth::user()->email === 'admin@admin.com')
                                    @if ($user->role !== 'superadmin' && $user->role !== 'admin')
                                        <a href="{{ route('admin.makeAdmin', $user->id) }}"
                                            class="text-green-500 hover:text-green-700 underline ml-5">Make Admin</a>
                                    @endif

                                    @if ($user->role === 'admin' && $user->email !== 'admin@admin.com')
                                        <a href="{{ route('admin.revokeAdmin', $user->id) }}"
                                            class="text-orange-500 hover:text-orange-700 underline ml-4">Desfazer
                                            Admin</a>
                                    @endif
                                @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->links() }}

    </div>




</x-app-layout>
