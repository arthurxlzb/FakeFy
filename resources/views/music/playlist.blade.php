@extends('layouts.app')

@section('content')
    <div class="max-w-5xl px-4 py-6 mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Minhas Playlists</h1>
            <a href="{{ route('playlists.create') }}"
               class="px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                + Criar Nova Playlist
            </a>
        </div>

        @if ($playlists->isEmpty())
            <p class="text-gray-600 dark:text-gray-300">Você ainda não criou nenhuma playlist.</p>
        @else
            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($playlists as $playlist)
                    <a href="{{ route('playlists.show', $playlist->id) }}"
                       class="block p-4 transition bg-white rounded-lg shadow hover:shadow-md dark:bg-gray-800 dark:text-white">
                        <h2 class="mb-1 text-lg font-bold">{{ $playlist->title }}</h2>
                        <h2 class="mb-1 text-lg font-bold">{{ $playlist->user->name }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $playlist->description ?? 'Sem descrição' }}</p>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">{{ $playlist->songs->count() }} música(s)</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
