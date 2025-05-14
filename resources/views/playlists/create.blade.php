@extends('layouts.app')

@section('title', 'Criar Playlist')

@section('content')
<div class="max-w-3xl px-6 py-10 mx-auto">
    <h2 class="mb-6 text-xl font-bold text-foreground">Nova Playlist</h2>

    <x-alert />

    <form action="{{ route('playlists.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block mb-2 text-xl font-medium text-foreground">Título</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="w-full px-4 py-3 text-lg border rounded-lg border-border bg-muted text-foreground focus:outline-none focus:ring-2 focus:ring-ring"
                required>
        </div>

        <div>
            <label for="description" class="block mb-2 text-xl font-medium text-foreground">Descrição</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-4 py-3 text-lg border rounded-lg border-border bg-muted text-foreground focus:outline-none focus:ring-2 focus:ring-ring">{{ old('description') }}</textarea>
        </div>



        <div>
            <label for="songs" class="block mb-2 text-xl font-medium text-foreground">Selecione as Músicas</label>
            <select name="songs[]" id="songs" multiple
                class="w-full px-4 py-3 text-lg border rounded-lg border-border bg-muted text-foreground focus:outline-none focus:ring-2 focus:ring-ring">
                @foreach ($songs as $song)
                    <option value="{{ $song->id }}" {{ in_array($song->id, old('songs', [])) ? 'selected' : '' }}>
                        {{ $song->title }} - {{ $song->singer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center space-x-2">
            <input type="hidden" name="is_public" value="0">
            <input type="checkbox" name="is_public" id="is_public" value="1"
                class="rounded border-border text-primary focus:ring-ring"
                {{ old('is_public') ? 'checked' : '' }}>
            <label for="is_public" class="text-lg text-foreground">Tornar pública</label>
        </div>

        <div class="flex space-x-8">
            <button type="submit"
                class="px-6 py-3 text-base font-semibold text-black transition border rounded-lg bg-muted hover:bg-muted/80 border-border">
                Criar
            </button>

            <a href="{{ route('home') }}"
                class="px-6 py-3 text-base font-semibold text-black transition border rounded-lg bg-muted hover:bg-muted/80 border-border">
                Voltar
            </a>
        </div>
    </form>
</div>
@endsection
