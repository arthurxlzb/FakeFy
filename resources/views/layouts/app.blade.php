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

<<body class="pb-16 font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    {{-- ✅ Menu inferior fixo --}}
    @auth

    <nav class="fixed bottom-0 left-0 right-0 z-50 bg-gray-900 border-t border-gray-700 shadow-md">
        <div class="flex justify-around max-w-4xl mx-auto">
            <a href="{{ route('home') }}"
               class="flex flex-col items-center justify-center w-full py-3 text-gray-300 transition hover:bg-gray-800 hover:text-white">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 12l9-9 9 9v9a2 2 0 01-2 2h-4a2 2 0 01-2-2V13H9v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                </svg>
                <span class="text-xs">Início</span>
            </a>
            <a href="{{ route('search') }}"
               class="flex flex-col items-center justify-center w-full py-3 text-gray-300 transition hover:bg-gray-800 hover:text-white">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span class="text-xs">Buscar</span>
            </a>
            <a href="{{ route('userplaylist') }}"
               class="flex flex-col items-center justify-center w-full py-3 text-gray-300 transition hover:bg-gray-800 hover:text-white">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 7h14M3 12h10m-10 5h6M17 7h2a2 2 0 012 2v10a2 2 0 01-2 2h-2"/>
                </svg>
                <span class="text-xs">Playlists</span>
            </a>
        </div>
    </nav>

    @endauth

    @yield('scripts')
</body>

</html>
