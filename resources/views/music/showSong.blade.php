@extends('layouts.app')

@section('title', $song->title)

@section('content')
<div class="p-6 text-white bg-black !important rounded-lg shadow-md">

    <!-- Título e duração -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">{{ $song->title }}</h2>
        <span class="px-3 py-1 text-sm text-black bg-black rounded-full">
            {{ $song->formatted_duration }}
        </span>
    </div>

    <!-- Player e botão de curtir ao lado -->
    <div class="flex items-center justify-center mb-4 space-x-4">
        <div class="flex items-center w-full max-w-2xl p-4 bg-black rounded-lg">
            <audio controls preload="metadata" class="w-full">
                <source src="{{ Storage::url($song->file_path) }}" type="audio/mpeg">
                Seu navegador não suporta o elemento de áudio.
            </audio>

            <!-- Botão de curtir com contador -->
            <form action="{{ route('songs.like', $song->id) }}" method="POST" class="flex items-center ml-4">
                @csrf
                <button type="submit" class="text-3xl transition-all hover:scale-125">
                    @if (auth()->user()->likedSongs->contains('song_id', $song->id))
                        <span class="text-red-500">❤️</span>
                    @else
                        <span class="text-white">🤍</span>
                    @endif
                </button>

                <!-- Contador de curtidas -->
                <span class="ml-2 text-lg text-white">
                    {{ $song->likes }}
                </span>
            </form>
        </div>
    </div>

    <!-- Botão que abre o modal -->
    <div class="mt-4 text-center">
        <button id="openModal"
            class="px-6 py-2 text-black rounded-lg bg-primary hover:primary">
            + Adicionar à Playlist
        </button>
    </div>

    <!-- Modal -->
    <div id="playlistModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-60">
        <div class="w-full max-w-md p-6 mx-auto text-white shadow-lg bg-zinc-900 rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">Escolher Playlist</h2>
                <button id="closeModal" class="text-2xl text-gray-400 hover:text-white">&times;</button>
            </div>

            <form id="add-to-playlist-form" method="POST" action="#">
                @csrf
                <input type="hidden" name="playlist_id" id="playlist_id_input">

                <label for="playlist-select" class="block mb-2 text-sm">Selecione uma playlist:</label>
                <select id="playlist-select" name="playlist_id" class="w-full p-2 mb-4 text-black rounded">
    @foreach (auth()->user()->playlists as $playlist)
       @continue(strtolower($playlist->title) === 'curtidas')

        <option value="{{ $playlist->id }}">{{ $playlist->title }}</option>
    @endforeach
</select>


                <button type="submit"
                    class="w-full px-4 py-2 text-black rounded-lg bg-primary hover:primary">
                    Adicionar Música
                </button>
            </form>
        </div>
    </div>

    <!-- Informações adicionais -->
    <div class="grid grid-cols-1 gap-6 mt-12 md:grid-cols-2">

        <div class="p-4 text-white bg-black rounded-lg">
            <h3 class="pb-2 mb-3 font-medium border-b border-gray-700">Informações</h3>
            <p class="mb-2"><span class="text-white">Álbum:</span> {{ $song->album->title }}</p>
            <p class="mb-2"><span class="text-white">Artista:</span> {{ $song->singer->name }}</p>
            <p class="mb-2"><span class="text-white">Número da Faixa:</span> {{ $song->track_number }}</p>
        </div>

        <div class="p-4 text-white bg-black rounded-lg">
            <h3 class="pb-2 mb-3 font-medium border-b border-gray-700">Arquivo</h3>

            @php
                $filePath = public_path('storage/' . $song->file_path);
                $size = file_exists($filePath) ? round(filesize($filePath) / 1024 / 1024, 2) : 'Indisponível';
            @endphp

            <p class="mb-2"><span class="text-white">Tamanho:</span> {{ $size }} {{ is_numeric($size) ? 'MB' : '' }}</p>
            <p class="mb-3"><span class="text-white">Formato:</span> {{ pathinfo($song->file_path, PATHINFO_EXTENSION) }}</p>

            <a href="{{ Storage::url($song->file_path) }}" download
                class="inline-block px-4 py-2 text-black transition rounded-lg bg-primary hover:primary">
                <i class="mr-2 fas fa-download"></i> Baixar Música
            </a>
        </div>

    </div>

    <!-- Botão de voltar -->
    <div class="mt-6 text-center">
        <a href="{{ route('home') }}" class="inline-block px-6 py-3 text-black transition duration-200 rounded-lg bg-primary hover:primary">
            <i class="mr-2 fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const openModalBtn = document.getElementById('openModal');
    const closeModalBtn = document.getElementById('closeModal');
    const modal = document.getElementById('playlistModal');
    const form = document.getElementById('add-to-playlist-form');
    const select = document.getElementById('playlist-select');

    openModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const playlistId = select.value;
        const songId = {{ $song->id }};
        const actionUrl = `/playlists/${playlistId}/songs/${songId}`;
        this.action = actionUrl;
        this.submit();
    });
</script>
@endsection
