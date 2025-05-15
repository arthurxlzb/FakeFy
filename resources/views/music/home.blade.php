@extends('layouts.app')

@section('content')
    <div class="container px-6 py-8 mx-auto">
        <!-- Título principal -->
        <h1 class="mb-8 text-xl font-bold text-center text-white">Bem-vindo ao Fakefy</h1>

        <!-- Músicas Populares -->
        <h2 class="mb-6 text-xl font-semibold text-white">Músicas Populares</h2>
        <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4">
            @foreach($songs as $song)
                <a href="{{ route('song.show', $song->id) }}"
                   class="block p-4 transition-all transform border shadow-md cursor-pointer border-muted bg-muted rounded-xl hover:scale-105 hover:shadow-lg hover:bg-muted/70">
                    <h3 class="text-xl font-semibold text-white">{{ $song->title }}</h3>
                    <p class="mt-2 text-sm text-gray-700">Cantor: {{ $song->singer->name }}</p>
                    <p class="mt-1 text-sm text-gray-700">Curtidas: {{ $song->likes }}</p>
                </a>
            @endforeach
        </div>

        <!-- Espaçamento forçado -->
        <div class="pt-24">
            <!-- Álbuns Recentes -->
            <h2 class="mb-6 text-xl font-semibold text-white">Álbuns Recentes</h2>
            <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 md:grid-cols-4">
                @foreach($albums as $album)
                    <a href="{{ route('album.show', $album->id) }}"
                       class="block p-4 transition-all transform border shadow-md cursor-pointer border-muted bg-muted rounded-xl hover:scale-105 hover:shadow-lg hover:bg-muted/70">
                        @if($album->cover_image)
                            <img src="{{ asset('storage/' . $album->cover_image) }}"
                                 alt="Capa do álbum: {{ $album->title }}"
                                 class="object-cover w-full h-48 mb-4 rounded-md">
                        @else
                            <div class="flex items-center justify-center w-full h-48 mb-4 rounded-md bg-muted">
                                <span class="text-gray-600">Sem Capa</span>
                            </div>
                        @endif
                        <h3 class="text-xl font-semibold text-white">{{ $album->title }}</h3>
                        <p class="mt-2 text-sm text-gray-700">Artista: {{ $album->singer->name }}</p>
                        <p class="mt-1 text-sm text-gray-700">Curtidas: {{ $album->likes }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
