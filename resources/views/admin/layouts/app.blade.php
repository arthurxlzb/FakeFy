<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title') - CRUDs Bolsa</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
</head>

<body class="pb-16 bg-gray-100 dark:bg-gray-900">

    <!-- Navegação -->
    <div class="bg-gray-800 shadow-md">
        @include('layouts.navigation')
    </div>

    <!-- Conteúdo principal -->
    <div class="mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
        @yield('content')
    </div>

    <!-- Scripts Extras -->
    @yield('scripts')
</body>
</html>
