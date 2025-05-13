@extends('admin.layouts.app')

@section('title', 'Álbum: ' . $album->title)

@section('content')
<div class="p-8 text-white bg-gray-900 rounded-lg shadow-lg">
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-bold">{{ $album->title }}</h1>
            <p class="text-gray-400">{{ $album->singer->name }}</p>
            <p class="mt-2">{{ $album->release_date->format('Y') }}</p>
        </div>

        @if($album->cover_image)
        <img src="{{ asset('storage/' . $album->cover_image) }}"
             alt="Capa do álbum"
             class="object-cover w-32 h-32 rounded-lg">
        @endif
    </div>

    <div class="mt-6">
        <h2 class="mb-4 text-2xl font-semibold">Músicas</h2>
        <div class="space-y-4">
            @forelse($album->songs as $song)
                <div class="grid items-center grid-cols-12 gap-4 p-5 bg-gray-800 rounded-lg">
                    <!-- Número e Título -->
                    <div class="flex items-center col-span-2 space-x-4">
                        <span class="mr-4 text-white">{{ $song->track_number }}.</span>
                        <span class="truncate">{{ $song->title }}</span>
                    </div>

                    <!-- Player de Áudio -->
                    <div class="col-span-6">
                        @if($song->file_path)
                            <audio controls class="w-full h-9">
                                <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mpeg">
                                Seu navegador não suporta o elemento de áudio.
                            </audio>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-400">Nenhuma música cadastrada neste álbum.</p>
            @endforelse
        </div>
    </div>

    <div class="flex mt-8 space-x-4">
        <a href="{{ route('admin.albums.index', $album->singer) }}"
           class="px-6 py-3 text-white transition duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">
            Voltar
        </a>
        <a href="{{ route('admin.albums.edit', $album) }}"
           class="px-6 py-3 text-white transition duration-300 bg-yellow-600 rounded-lg hover:bg-yellow-700">
            Editar
        </a>
    </div>
</div>
@endsection
