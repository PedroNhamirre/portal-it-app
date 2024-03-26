<x-app-layout>
    <x-slot name="header">
        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
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




</x-app-layout>
