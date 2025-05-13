<!-- resources/views/admin/songs/show.blade.php -->

@extends('admin.layouts.app')

@section('title', $song->title)

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    @include('admin.songs.partials.breadcrumb', ['album' => $album, 'song' => $song])

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">{{ $song->title }}</h2>
        <span class="px-3 py-1 text-sm bg-gray-700 rounded-full">
            {{ $song->duration }}
        </span>
    </div>

    <!-- Player centralizado -->
    <div class="flex justify-center mb-8">
        <div class="w-full max-w-2xl p-4 bg-gray-800 rounded-lg">
            <audio controls preload="metadata" class="w-full">
                <source src="{{ Storage::url($song->file_path) }}" type="audio/mpeg">
                Seu navegador não suporta o elemento de áudio.
            </audio>
        </div>
    </div>

    <!-- Informações adicionais -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Informações da música -->
        <div class="p-4 bg-gray-800 rounded-lg">
            <h3 class="pb-2 mb-3 font-medium border-b border-gray-700">Informações</h3>
            <p class="mb-2"><span class="text-gray-400">Álbum:</span> {{ $song->album->title }}</p>
            <p class="mb-2"><span class="text-gray-400">Artista:</span> {{ $song->singer->name }}</p>
            <p class="mb-2"><span class="text-gray-400">Número da Faixa:</span> {{ $song->track_number }}</p>
        </div>

        <!-- Informações do arquivo -->
        <div class="p-4 bg-gray-800 rounded-lg">
            <h3 class="pb-2 mb-3 font-medium border-b border-gray-700">Arquivo</h3>
            <p class="mb-2"><span class="text-gray-400">Tamanho:</span> {{ round(Storage::size('public/' . $song->file_path) / 1024 / 1024, 2) }} MB</p>
            <p class="mb-3"><span class="text-gray-400">Formato:</span> {{ pathinfo($song->file_path, PATHINFO_EXTENSION) }}</p>
            <a href="{{ Storage::url($song->file_path) }}" download
               class="inline-block px-4 py-2 transition bg-blue-600 rounded hover:bg-blue-700">
               <i class="mr-2 fas fa-download"></i> Baixar Música
            </a>
        </div>
    </div>
</div>
@endsection
