@extends('admin.layouts.app')

@section('title', 'Detalhes da Playlist')

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold">{{ $playlist->title }}</h2>
        <a href="{{ route('playlists.index') }}"
            class="px-4 py-2 text-sm font-bold text-white bg-gray-700 rounded hover:bg-gray-600">
            <i class="mr-2 fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="mb-4">
        <p><span class="font-semibold text-gray-300">Descrição:</span> {{ $playlist->description ?? '-' }}</p>
        <p><span class="font-semibold text-gray-300">Visibilidade:</span>
            <span class="{{ $playlist->is_public ? 'text-green-400' : 'text-red-400' }}">
                {{ $playlist->is_public ? 'Pública' : 'Privada' }}
            </span>
        </p>
    </div>

    <div class="mt-6">
        <h3 class="pb-2 mb-4 text-xl font-semibold border-b border-gray-700">Músicas da Playlist</h3>

        @if ($playlist->songs->isEmpty())
            <p class="text-gray-400">Esta playlist ainda não possui músicas.</p>
        @else
            <div class="space-y-4">
                @foreach ($playlist->songs as $song)
                    <div class="p-4 bg-gray-800 rounded shadow-sm">
                        <p class="mb-2 font-semibold">{{ $song->title }}
                            <span class="text-sm text-gray-400">({{ $song->singer->name }})</span>
                        </p>
                        <audio controls class="w-full">
                            <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mpeg">
                            Seu navegador não suporta o elemento de áudio.
                        </audio>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
