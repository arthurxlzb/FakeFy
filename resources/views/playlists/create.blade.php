@extends('admin.layouts.app')

@section('title', 'Criar Playlist')

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    <h2 class="mb-4 text-2xl font-semibold">Nova Playlist</h2>

    <x-alert />

    <form action="{{ route('playlists.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="title" class="block mb-1">Título</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="w-full px-4 py-2 text-white bg-gray-800 rounded" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-1">Descrição</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-4 py-2 text-white bg-gray-800 rounded">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="user_id" class="block mb-1">Selecione o Usuário</label>
            <select name="user_id" id="user_id" class="w-full px-4 py-2 text-white bg-gray-800 rounded">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="songs" class="block mb-1">Selecione as Músicas</label>
            <select name="songs[]" id="songs" multiple class="w-full px-4 py-2 text-white bg-gray-800 rounded">
                @foreach ($songs as $song)
                    <option value="{{ $song->id }}" {{ in_array($song->id, old('songs', [])) ? 'selected' : '' }}>
                        {{ $song->title }} - {{ $song->singer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="is_public" class="flex items-center space-x-2">
                <input type="hidden" name="is_public" value="0">
                <input type="checkbox" name="is_public" id="is_public" value="1"
                    {{ old('is_public') ? 'checked' : '' }}>
                <span>Tornar pública</span>
            </label>
        </div>


        <button type="submit" class="px-6 py-2 font-bold text-white bg-green-600 rounded hover:bg-green-800">
            Criar
        </button>
    </form>
</div>
@endsection
