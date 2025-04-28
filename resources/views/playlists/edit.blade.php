@extends('admin.layouts.app')

@section('title', 'Editar Playlist')

@section('content')
<div class="p-6 text-white bg-gray-800 rounded-lg shadow-md">
    <h2 class="mb-4 text-2xl font-semibold">
        Editar Playlist
    </h2>

    <x-alert />

    <!-- Formulário de atualização -->
    <form action="{{ route('playlists.update', $playlist) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block mb-1">Título</label>
            <input type="text" name="title" id="title" value="{{ old('title', $playlist->title) }}"
                class="w-full px-4 py-2 text-white bg-gray-800 rounded focus:ring-2 focus:ring-green-500"
                style="background-color: #3A3A3A;" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-1">Descrição</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-4 py-2 text-white bg-gray-800 rounded focus:ring-2 focus:ring-green-500"
                style="background-color: #3A3A3A;">{{ old('description', $playlist->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="user_id" class="block mb-1">Selecione o Usuário</label>
            <select name="user_id" id="user_id"
                class="w-full px-4 py-2 text-white bg-gray-800 rounded focus:ring-2 focus:ring-green-500"
                style="background-color: #3A3A3A;">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $playlist->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="songs" class="block mb-1">Selecione as Músicas</label>
            <select name="songs[]" id="songs" multiple
                class="w-full px-4 py-2 text-white bg-gray-800 rounded focus:ring-2 focus:ring-green-500"
                style="background-color: #3A3A3A;">
                @foreach ($songs as $song)
                    <option value="{{ $song->id }}"
                        {{ in_array($song->id, old('songs', $playlist->songs->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                        {{ $song->title }} - {{ $song->singer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="is_public" class="flex items-center space-x-2">
                <input type="checkbox" name="is_public" id="is_public" value="1"
                    style="background-color: #3A3A3A;"
                    {{ old('is_public', $playlist->is_public) ? 'checked' : '' }}>
                <span>Tornar pública</span>
            </label>
        </div>

        <!-- Botões de ação -->
        <div class="flex flex-wrap gap-4">
            <button type="submit" class="px-6 py-2 font-bold text-white bg-green-600 rounded hover:bg-green-800">
                Atualizar Playlist
            </button>

            <a href="{{ route('playlists.index') }}"
                class="px-6 py-2 font-bold text-white bg-gray-600 rounded hover:bg-gray-800">
                Voltar
            </a>
        </div>
    </form>

    <!-- Formulário separado para exclusão -->
    <form action="{{ route('playlists.destroy', $playlist) }}" method="POST" class="mt-6">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta playlist?')"
            class="px-6 py-2 font-bold text-white bg-gray-700 rounded hover:bg-gray-600">
            Excluir Playlist
        </button>
    </form>

</div>
@endsection
