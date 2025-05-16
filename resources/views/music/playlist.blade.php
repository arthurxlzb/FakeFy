@extends('layouts.app')

@section('content')
    <div class="max-w-3xl px-6 py-10 mx-auto">
        <div class="flex flex-col items-start justify-between gap-4 mb-8 sm:flex-row sm:items-center">
            <h1 class="text-xl font-bold text-foreground">Minhas Playlists</h1>
            <a href="{{ route('playlists.create') }}"
               class="inline-flex items-center px-5 py-3 text-lg font-medium text-black transition-colors bg-green-600 rounded-lg hover:bg-green-700">
                + Criar Nova Playlist
            </a>
        </div>

        @if ($playlists->isEmpty())
            <p class="text-base text-muted-foreground">Você ainda não criou nenhuma playlist.</p>
        @else
            <div class="space-y-4">
                @foreach ($playlists as $playlist)
                    <a href="{{ route('playlists.show', $playlist->id) }}"
                       class="block w-full p-5 transition-all border bg-muted border-border rounded-2xl hover:bg-muted/80 hover:shadow">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-xl font-semibold text-foreground">{{ $playlist->title }}</h2>
                            <span class="text-base text-muted-foreground">{{ $playlist->songs->count() }} música(s)</span>
                        </div>
                        <p class="text-base text-muted-foreground">
                            {{ $playlist->description ?? 'Sem descrição' }}
                        </p>
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Botão de voltar centralizado --}}
        <div class="flex justify-center mt-8">
            <a href="{{ route('home') }}"
               class="inline-flex items-center px-6 py-3 text-base font-medium rounded-lg bg-backgroud text-primary hover:bg-muted">
                 Voltar
            </a>
        </div>
    </div>
@endsection
