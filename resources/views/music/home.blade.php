@extends('layouts.app')

@section('content')
    <div class="container px-6 py-8 mx-auto">
        <!-- Título principal -->
        <h1 class="mb-8 text-4xl font-bold text-center text-gray-900">Bem-vindo ao Fakefy</h1>

        <!-- Músicas Populares -->
        <h2 class="mb-6 text-3xl font-semibold text-gray-800">Músicas Populares</h2>
        <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4">
            @foreach($songs as $song)
                <div class="p-4 transition-all transform bg-white border border-gray-300 shadow-md rounded-xl hover:scale-105 hover:shadow-lg">
                    <a href="{{ route('song.show', $song->id) }}" class="block text-xl font-semibold text-gray-900 hover:text-green-600">
                        {{ $song->title }}
                    </a>
                    <p class="mt-2 text-sm text-gray-700">Cantor: {{ $song->singer->name }}</p>
                    <p class="mt-1 text-sm text-gray-700">Curtidas: {{ $song->likes }}</p>
                </div>
            @endforeach
        </div>

        <!-- Espaçamento forçado -->
        <div class="pt-24">
            <!-- Álbuns Recentes -->
            <h2 class="mb-6 text-3xl font-semibold text-gray-800">Álbuns Recentes</h2>
            <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4">
                @foreach($albums as $album)
                    <div class="p-4 transition-all transform bg-white border border-gray-300 shadow-md rounded-xl hover:scale-105 hover:shadow-lg">
                        <a href="{{ route('album.show', $album->id) }}" class="block text-xl font-semibold text-gray-900 hover:text-green-600">
                            <!-- Exibindo a Capa do Álbum -->
                            @if($album->cover_image)
                                <img src="{{ asset('storage/' . $album->cover_image) }}" alt="Capa do álbum: {{ $album->title }}" class="object-cover w-full h-48 mb-4 rounded-md">
                            @else
                                <div class="flex items-center justify-center w-full h-48 mb-4 bg-gray-200 rounded-md">
                                    <span class="text-gray-600">Sem Capa</span>
                                </div>
                            @endif
                            {{ $album->title }}
                        </a>
                        <p class="mt-2 text-sm text-gray-700">Artista: {{ $album->singer->name }}</p>
                        <p class="mt-1 text-sm text-gray-700">Curtidas: {{ $album->likes }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
