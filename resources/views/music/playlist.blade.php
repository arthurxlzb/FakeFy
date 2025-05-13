@extends('layouts.app')

@section('content')
    <div class="px-6 py-8 mx-auto max-w-7xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-semibold text-white">Minhas Playlists</h1>
            <a href="{{ route('playlists.create') }}"
               class="px-6 py-3 text-sm font-semibold text-white transition bg-green-600 rounded-md hover:bg-green-700">
                + Criar Nova Playlist
            </a>
        </div>

        @if ($playlists->isEmpty())
            <p class="text-lg text-gray-400">Você ainda não criou nenhuma playlist.</p>
        @else
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($playlists as $playlist)
                    <a href="{{ route('playlists.show', $playlist->id) }}"
                       class="block p-6 text-white transition transform bg-gray-800 shadow-lg rounded-xl hover:scale-105 hover:bg-gray-700">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold">{{ $playlist->title }}</h2>
                        </div>
                        <h3 class="mt-2 text-sm font-medium text-gray-400">{{ $playlist->user->name }}</h3>
                        <p class="mt-2 text-sm text-gray-500">{{ $playlist->description ?? 'Sem descrição' }}</p>
                        <p class="mt-3 text-xs text-gray-400">{{ $playlist->songs->count() }} música(s)</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
