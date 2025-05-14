@extends('layouts.app')

@section('title', $album->title)

@section('content')
<div class="max-w-3xl px-6 py-10 mx-auto">

    <!-- Título e data -->
    <div class="flex flex-col items-start justify-between gap-4 mb-8 md:flex-row md:items-center">
        <h1 class="text-3xl font-bold text-foreground">{{ $album->title }}</h1>
        <span class="inline-block px-4 py-1 text-sm font-medium rounded-full bg-muted text-muted-foreground">
            Lançado em {{ \Carbon\Carbon::parse($album->release_date)->format('d/m/Y') }}
        </span>
    </div>

    <!-- Capa e Curtir -->
    <div class="flex flex-col items-center gap-6 mb-10 md:flex-row">
        @if ($album->cover_image)
            <img src="{{ Storage::url($album->cover_image) }}"
                 alt="Capa do Álbum"
                 class="object-cover w-64 h-64 border shadow-md rounded-xl border-border">
        @endif

        <!-- Curtir -->
        <form action="{{ route('albums.like', $album->id) }}" method="POST" class="flex items-center space-x-3">
            @csrf
            @php
                $user = auth()->user();
                $liked = \DB::table('album_likes')->where('user_id', $user->id)->where('album_id', $album->id)->exists();
            @endphp
            <button type="submit"
                    class="flex items-center justify-center w-12 h-12 text-2xl transition-transform rounded-full hover:scale-110 bg-muted">
                @if ($liked)
                    <span class="text-red-500">❤️</span>
                @else
                    <span class="text-muted-foreground">🤍</span>
                @endif
            </button>
            <span class="text-lg font-medium text-muted-foreground">{{ $album->likes }}</span>
        </form>
    </div>

    <!-- Caixa com título e músicas -->
    <div class="mt-8 bg-black border rounded-lg shadow-md border-zinc-700">
        <h2 class="px-6 py-4 text-xl font-bold text-black border-b border-zinc-600">Músicas do Álbum</h2>
        <ul class="divide-y divide-zinc-600">
            @foreach($songs as $song)
                <li class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('song.show', $song->id) }}" class="text-black hover:text-gray-300">
                            <span class="text-base font-medium">{{ $song->title }}</span>
                        </a>

                        <!-- Botão de curtir -->
                        <form action="{{ route('songs.like', $song->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-3xl transition-all hover:scale-125">
                                @if (auth()->user()->likedSongs->contains('song_id', $song->id))
                                    <span class="text-red-500">❤️</span>
                                @else
                                    <span class="text-black">🤍</span>
                                @endif
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Voltar -->
    <div class="mt-10 text-center">
        <a href="{{ route('home') }}"
           class="inline-flex items-center px-6 py-3 text-sm font-medium text-black transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
            <i class="mr-2 fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>
@endsection
