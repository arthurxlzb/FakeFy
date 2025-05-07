<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen">
        <!-- Navegação Principal -->
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex items-center shrink-0">
                            <a href="{{ route('home') }}">
                                <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" />
                            </a>
                        </div>
                        <!-- Se o usuário for administrador, mostra os links de admin -->
                        @auth
                            @if (auth()->user()->isAdm())
                                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                        {{ __('Users') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('admin.singers.index')" :active="request()->routeIs('admin.singers.*')">
                                        {{ __('Singers') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('admin.albums.index')" :active="request()->routeIs('admin.albums.*')">
                                        {{ __('Albums') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('admin.songs.index')" :active="request()->routeIs('admin.songs.*')">
                                        {{ __('Songs') }}
                                    </x-nav-link>
                                    <x-nav-link :href="route('playlists.index')" :active="request()->routeIs('playlists.*')">
                                        {{ __('Playlists') }}
                                    </x-nav-link>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <!-- Dropdown de Configurações -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        @auth
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1">
                                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                         onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Menu de Usuário (Cópia do componente admin, ajustado para usuários) -->
            @auth
                <div class="border-t border-gray-700">
                    <div class="px-4 py-3">
                        <div class="flex space-x-8">
                            <!-- Para Teste: copiando a estrutura de navegação do admin -->
                            <x-nav-link :href="route('home')" class="flex items-center text-gray-300 hover:text-white">
                                <i class="mr-2 fas fa-home"></i>
                                Início
                            </x-nav-link>
                            <x-nav-link :href="route('search')" class="flex items-center text-gray-300 hover:text-white">
                                <i class="mr-2 fas fa-search"></i>
                                Buscar
                            </x-nav-link>
                            <x-nav-link :href="route('userplaylist')" class="flex items-center text-gray-300 hover:text-white">
                                <i class="mr-2 fas fa-list"></i>
                                Playlists
                            </x-nav-link>
                        </div>
                    </div>
                </div>
            @endauth
        </nav>

        <!-- Cabeçalho da Página -->
        @isset($header)
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Conteúdo da Página -->
        <main class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
