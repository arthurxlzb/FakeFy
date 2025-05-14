@extends('layouts.app')

@section('content')
    <div class="max-w-2xl px-4 py-10 mx-auto">
        <h1 class="mb-8 text-3xl font-semibold text-center text-foreground">Buscar Músicas</h1>

        <!-- Campo de busca com autocomplete -->
        <div class="relative">
            <input
                type="text"
                id="searchInput"
                placeholder="Digite o nome da música..."
                class="w-full px-4 py-3 border rounded-lg text-foreground placeholder-muted bg-background border-border focus:ring-2 focus:ring-green-500 focus:outline-none"
            >
            <ul id="autocompleteResults" class="absolute z-10 hidden w-full mt-2 overflow-hidden border rounded-lg shadow-xl border-border bg-background text-foreground">
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
            html += `<li class="px-4 py-2 font-medium text-green-600 dark:text-green-400">Músicas</li>`;
            data.songs.forEach(song => {
                html += `
                    <li class="px-4 py-2 transition-colors duration-200 cursor-pointer hover:bg-muted">
                        <a href="/song/${song.id}" class="block text-foreground hover:underline">${song.title}</a>
                    </li>
                `;
            });
        }

        if (data.albums.length > 0) {
            html += `<li class="px-4 py-2 mt-2 font-medium text-blue-600 dark:text-blue-400">Álbuns</li>`;
            data.albums.forEach(album => {
                html += `
                    <li class="px-4 py-2 transition-colors duration-200 cursor-pointer hover:bg-muted">
                        <a href="/album/${album.id}" class="block text-foreground hover:underline">${album.title}</a>
                    </li>
                `;
            });
        }

        if (html === '') {
            html = '<li class="px-4 py-2 text-muted-foreground">Nenhum resultado</li>';
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
