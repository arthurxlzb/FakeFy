@extends('layouts.app')

@section('title', $song->title)

@section('content')
<div class="p-6 text-black bg-black !important rounded-lg shadow-md">

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
                        <span class="text-black">🤍</span>
                    @endif
                </button>

                <!-- Contador de curtidas -->
                <span class="ml-2 text-lg text-black">
                    {{ $song->likes }}
                </span>
            </form>
        </div>
    </div>

    <!-- Informações adicionais -->
    <div class="grid grid-cols-1 gap-6 mt-12 md:grid-cols-2">

        <div class="p-4 text-black bg-black rounded-lg">
            <h3 class="pb-2 mb-3 font-medium border-b border-gray-700">Informações</h3>
            <p class="mb-2"><span class="text-black">Álbum:</span> {{ $song->album->title }}</p>
            <p class="mb-2"><span class="text-black">Artista:</span> {{ $song->singer->name }}</p>
            <p class="mb-2"><span class="text-black">Número da Faixa:</span> {{ $song->track_number }}</p>
        </div>

        <div class="p-4 text-black bg-black rounded-lg">
            <h3 class="pb-2 mb-3 font-medium border-b border-gray-700">Arquivo</h3>

            @php
                $filePath = public_path('storage/' . $song->file_path);
                $size = file_exists($filePath) ? round(filesize($filePath) / 1024 / 1024, 2) : 'Indisponível';
            @endphp

            <p class="mb-2"><span class="text-black">Tamanho:</span> {{ $size }} {{ is_numeric($size) ? 'MB' : '' }}</p>
            <p class="mb-3"><span class="text-black">Formato:</span> {{ pathinfo($song->file_path, PATHINFO_EXTENSION) }}</p>

            <a href="{{ Storage::url($song->file_path) }}" download
                class="inline-block px-4 py-2 text-black transition bg-blue-600 rounded-lg hover:bg-blue-700">
                <i class="mr-2 fas fa-download"></i> Baixar Música
            </a>
        </div>

    </div>

    <!-- Botão de voltar -->
    <div class="mt-6 text-center">
        <a href="{{ route('home') }}" class="inline-block px-6 py-3 text-black transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
            <i class="mr-2 fas fa-arrow-left"></i> Voltar
        </a>
    </div>

</div>
@endsection
