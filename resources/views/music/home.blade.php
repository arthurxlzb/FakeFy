@extends('layouts.app')

@section('content')
    <div class="container px-4 py-6 mx-auto">
        <!-- Título principal -->
        <h1 class="mb-8 text-4xl font-bold text-center text-white">Bem-vindo ao Fakefy</h1>

        <!-- Músicas Populares -->
        <h2 class="mb-4 text-2xl font-semibold text-white">Músicas Populares</h2>
        <div class="grid grid-cols-2 gap-4 mb-8 sm:grid-cols-3 md:grid-cols-4">
            @foreach($songs as $song)
                <div class="p-4 transition transform bg-gray-800 rounded-lg shadow-lg hover:scale-105">
                    <a href="{{ route('song.show', $song->id) }}" class="text-xl font-medium text-white hover:text-green-500">
                        {{ $song->title }}
                    </a>
                    <p class="mt-2 text-gray-400">Cantor: {{ $song->singer->name }}</p>
                </div>
            @endforeach
        </div>

        <!-- Álbuns Recentes -->
        <h2 class="mb-4 text-2xl font-semibold text-white">Álbuns Recentes</h2>
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
            @foreach($albums as $album)
                <div class="p-4 transition transform bg-gray-800 rounded-lg shadow-lg hover:scale-105">
                    <a href="{{ route('album.show', $album->id) }}" class="text-xl font-medium text-white hover:text-green-500">
                        {{ $album->title }}
                    </a>
                    <p class="mt-2 text-gray-400">Artista: {{ $album->singer->name }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
