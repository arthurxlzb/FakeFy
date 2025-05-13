@extends('layouts.app')

@section('title', $album->title)

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">

    <!-- Título e data -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold">{{ $album->title }}</h2>
        <span class="px-3 py-1 text-sm bg-gray-700 rounded-full">
            Lançado em {{ \Carbon\Carbon::parse($album->release_date)->format('d/m/Y') }}
        </span>
    </div>

    <!-- Capa e botão de curtir -->
    <div class="flex flex-col items-center justify-center mb-6 space-y-4 md:flex-row md:space-y-0 md:space-x-6">
        @if ($album->cover_image)
            <img src="{{ Storage::url($album->cover_image) }}" alt="Capa do Álbum" class="w-64 rounded-lg shadow-md">
        @endif

        <!-- Botão de curtir com contador -->
        <form action="{{ route('albums.like', $album->id) }}" method="POST" class="flex items-center">
            @csrf
            <button type="submit" class="text-3xl transition-all hover:scale-125">
                @php
                    $user = auth()->user();
                    $liked = \DB::table('album_likes')->where('user_id', $user->id)->where('album_id', $album->id)->exists();
                @endphp
                @if ($liked)
                    <span class="text-red-500">❤️</span>
                @else
                    <span class="text-white">🤍</span>
                @endif
            </button>
            <span class="ml-2 text-lg">{{ $album->likes }}</span>
        </form>
    </div>

    <!-- Lista de músicas -->
    <div class="mt-8">
        <h3 class="mb-4 text-xl font-semibold border-b border-gray-700">Músicas do Álbum</h3>
        <ul class="space-y-2">
            @foreach($songs as $song)
                <li class="p-3 transition bg-gray-800 rounded hover:bg-gray-700">
                    <a href="{{ route('song.show', $song->id) }}" class="block text-white hover:underline">
                        {{ $song->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Botão de voltar -->
    <div class="mt-8 text-center">
        <a href="{{ route('home') }}" class="inline-block px-6 py-3 text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
            <i class="mr-2 fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>
@endsection
