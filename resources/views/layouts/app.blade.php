<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fakefy') }}</title>

    <!-- Fonte e Tailwind -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Ícones Lucide (opcional para ShadCN-like) -->
    <script src="https://unpkg.com/lucide@latest" defer></script>
</head>

<body class="min-h-screen font-sans antialiased bg-background text-foreground">
    <div class="flex flex-col min-h-screen">

        {{-- Navegação Principal --}}
        @include('layouts.navigation')

        {{-- Cabeçalho da Página (Se existir) --}}
        @isset($header)
            <header class="shadow bg-muted">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Conteúdo Principal --}}
        <main class="flex-1 w-full px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

    {{-- Scripts adicionais --}}
    @yield('scripts')
</body>
</html>
