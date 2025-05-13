<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fakefy') }} - Admin</title>

    <!-- Fontes e Estilos -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .admin-sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #1f2937; /* bg-gray-800 */
            color: white;
            padding-top: 20px;
            z-index: 40;
        }
        .admin-sidebar a {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: background 0.2s;
        }
        .admin-sidebar a:hover {
            background-color: #374151; /* bg-gray-700 */
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-100 dark:bg-gray-900 dark:text-gray-100">

    <div class="flex min-h-screen">

        <!-- Sidebar Administrativo -->
        <aside class="admin-sidebar">
            <h2 class="mb-6 text-xl font-bold text-center">Administração</h2>
            <a href="{{ route('admin.users.index') }}">Usuários</a>
            <a href="{{ route('admin.songs.index') }}">Músicas</a>
            <a href="{{ route('admin.albums.index') }}">Álbuns</a>
            <a href="{{ route('playlists.index') }}">Playlists</a>
        </aside>

        <!-- Conteúdo Principal -->
        <div class="flex-1 p-6 ml-64">

            <!-- Cabeçalho se existir -->
            @isset($header)
                <header class="mb-4 bg-white rounded-lg shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Conteúdo -->
            <main>
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>
