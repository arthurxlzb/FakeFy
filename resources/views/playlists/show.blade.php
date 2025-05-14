@extends('layouts.app')

@section('title', 'Detalhes da Playlist')

@section('content')
<div class="max-w-4xl px-6 py-10 mx-auto">
    <div class="mb-8 space-y-2">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-foreground">{{ $playlist->title }}</h2>
            <a href="{{ route('UserPlaylists') }}"
               class="inline-flex items-center py-6 text-xl font-medium text-black bg-black rounded-md px-7 hover:bg-neutral-800">
                <i class="mr-4 fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>

        <p class="text-muted-foreground">
            <span class="font-medium text-foreground">Descrição:</span> {{ $playlist->description ?? 'Sem descrição' }}
        </p>
        <p class="text-muted-foreground">
            <span class="font-medium text-foreground">Visibilidade:</span>
            <span class="{{ $playlist->is_public ? 'text-green-500' : 'text-red-500' }}">
                {{ $playlist->is_public ? 'Pública' : 'Privada' }}
            </span>
        </p>
    </div>

    <div>
        <h3 class="pb-2 mb-4 text-xl font-semibold border-b text-foreground border-border">Músicas da Playlist</h3>

        @if ($playlist->songs->isEmpty())
            <p class="text-muted-foreground">Esta playlist ainda não possui músicas.</p>
        @else
            <div class="space-y-4">
                @foreach ($playlist->songs as $song)
                    <div class="p-5 transition border shadow-sm rounded-2xl bg-muted border-border hover:shadow-md">
                        <p class="mb-2 font-semibold text-foreground">
                            {{ $song->title }}
                            <span class="text-sm text-muted-foreground">({{ $song->singer->name }})</span>
                        </p>

                        <div class="flex items-center justify-between w-full gap-4">
                            <audio controls class="flex-1">
                                <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mpeg">
                                Seu navegador não suporta o elemento de áudio.
                            </audio>

                            <!-- Botão de curtir com contador -->
                            <form action="{{ route('songs.like', $song->id) }}" method="POST" class="flex items-center">
                                @csrf
                                <button type="submit" class="text-3xl transition-all hover:scale-150">
                                    @if (auth()->user()->likedSongs->contains('song_id', $song->id))
                                        <span class="text-red-500">❤️</span>
                                    @else
                                        <span class="text-white">🤍</span>
                                    @endif
                                </button>
                                <span class="ml-2 text-sm text-white">
                                    {{ $song->likes }}
                                </span>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
