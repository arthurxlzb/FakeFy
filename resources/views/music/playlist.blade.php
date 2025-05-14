@extends('layouts.app')

@section('content')
    <div class="px-6 py-10 mx-auto max-w-7xl">
        <div class="flex flex-col items-start justify-between gap-4 mb-8 sm:flex-row sm:items-center">
            <h1 class="text-3xl font-bold text-foreground">Minhas Playlists</h1>
            <a href="{{ route('playlists.create') }}"
               class="inline-flex items-center px-5 py-3 text-sm font-medium text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700">
                + Criar Nova Playlist
            </a>
        </div>

        @if ($playlists->isEmpty())
            <p class="text-base text-muted-foreground">Você ainda não criou nenhuma playlist.</p>
        @else
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($playlists as $playlist)
                    <a href="{{ route('playlists.show', $playlist->id) }}"
                       class="block p-6 transition-all border shadow-sm border-border rounded-2xl bg-muted hover:bg-muted/80 hover:shadow-md">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-lg font-semibold text-foreground">{{ $playlist->title }}</h2>
                        </div>
                        <h3 class="text-sm text-muted-foreground">{{ $playlist->user->name }}</h3>
                        <p class="mt-2 text-sm text-muted-foreground">
                            {{ $playlist->description ?? 'Sem descrição' }}
                        </p>
                        <p class="mt-3 text-xs text-muted-foreground">{{ $playlist->songs->count() }} música(s)</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
