@extends('layouts.app')

@section('content')
    <div class="max-w-2xl px-4 py-10 mx-auto">
        <h1 class="mb-8 text-3xl font-bold text-center text-gray-800 dark:text-white">
            Buscar Músicas
        </h1>

        <!-- Campo de busca com autocomplete -->
        <div class="relative">
            <input
                type="text"
                id="searchInput"
                placeholder="Digite o nome da música..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none dark:bg-gray-800 dark:text-white dark:border-gray-600"
            >
            <ul id="autocompleteResults" class="absolute z-10 hidden w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800">
                <!-- Resultados aqui -->
            </ul>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const resultsList = document.getElementById('autocompleteResults');

    searchInput.addEventListener('input', async () => {
        const query = searchInput.value.trim();
        if (query.length < 2) {
            resultsList.innerHTML = '';
            resultsList.classList.add('hidden');
            return;
        }

        const response = await fetch(`/autocomplete?query=${encodeURIComponent(query)}`);
        const data = await response.json();

        let html = '';

        if (data.songs.length > 0) {
            html += `<li class="px-4 py-2 font-semibold text-green-600 dark:text-green-400">Músicas</li>`;
            data.songs.forEach(song => {
                html += `
                    <li class="px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                        <a href="/song/${song.id}" class="block text-gray-800 dark:text-white">${song.title}</a>
                    </li>
                `;
            });
        }

        if (data.albums.length > 0) {
            html += `<li class="px-4 py-2 mt-2 font-semibold text-blue-600 dark:text-blue-400">Álbuns</li>`;
            data.albums.forEach(album => {
                html += `
                    <li class="px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                        <a href="/album/${album.id}" class="block text-gray-800 dark:text-white">${album.title}</a>
                    </li>
                `;
            });
        }

        if (html === '') {
            html = '<li class="px-4 py-2 text-gray-500 dark:text-gray-400">Nenhum resultado</li>';
        }

        resultsList.innerHTML = html;
        resultsList.classList.remove('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !resultsList.contains(e.target)) {
            resultsList.classList.add('hidden');
        }
    });
</script>

@endsection
