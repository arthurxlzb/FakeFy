@extends('layouts.app')

@section('title', 'Detalhes da Playlist')

@section('content')
<div class="max-w-4xl px-6 py-10 mx-auto">
    <div class="mb-8 space-y-2">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-bold text-foreground">{{ $playlist->title }}</h2>

            <div class="flex flex-col items-center gap-3 sm:flex-row sm:gap-4">
                <!-- Botão Voltar -->
                <a href="{{ route('UserPlaylists') }}"
                   class="inline-flex items-center px-6 py-3 text-xl font-medium bg-black rounded-md text-primary hover:bg-neutral-800">
                    <i class="mr-2 fa-solid fa-arrow-left"></i> Voltar
                </a>

                <!-- Botão Excluir Playlist com Confirmação -->
                <form action="{{ route('playlists.destroy', $playlist->id) }}" method="POST"
                      onsubmit="return confirm('Tem certeza que deseja excluir esta playlist?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 text-xl font-medium text-red-700 transition-colors bg-black rounded-md hover:bg-red-700">
                        <i class="mr-2 fa-solid fa-trash"></i> Excluir
                    </button>
                </form>
            </div>
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

            <!-- Curtir -->
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

            <!-- Remover da Playlist -->
            <form action="{{ route('playlists.remove-song', ['playlist' => $playlist->id, 'song' => $song->id]) }}"
                  method="POST"
                  onsubmit="return confirm('Deseja remover esta música da playlist?');"
                  class="ml-4">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-3 py-2 text-base text-red-500 transition-colors border border-red-500 rounded-md hover:bg-red-500 hover:text-white">
                    <i class="mr-1 fa-solid fa-minus"></i> Remover
                </button>
            </form>
        </div>
    </div>
    @endforeach


            </div>
        @endif
    </div>
</div>
@endsection
