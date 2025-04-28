@extends('admin.layouts.app')

@section('title', 'Editar Música: ' . $song->title)

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    @include('admin.songs.partials.breadcrumb', ['album' => $album, 'song' => $song])

    <h2 class="mb-6 text-2xl font-bold">Editar Música</h2>

    <form action="{{ route('admin.albums.songs.update', [$album->id, $song->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Informações da Música -->
            <div class="md:col-span-2">
                <div class="space-y-4">
                    <!-- Título da Música -->
                    <div>
                        <label for="title" class="block mb-2 font-medium">Título da Música</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $song->title) }}" required
                            class="w-full p-3 bg-gray-800 border border-gray-700 rounded focus:border-blue-500 focus:outline-none">
                    </div>

                    <!-- Número da Faixa -->
                    <div>
                        <label for="track_number" class="block mb-2 font-medium">Número da Faixa</label>
                        <input type="number" id="track_number" name="track_number" min="1"
                            value="{{ old('track_number', $song->track_number) }}" required
                            class="w-full p-3 bg-gray-800 border border-gray-700 rounded focus:border-blue-500 focus:outline-none">
                    </div>

                    <!-- Arquivo de Áudio -->
                    <div>
                        <label for="song_file" class="block mb-2 font-medium">Arquivo de Áudio (Atual)</label>
                        <div class="w-full overflow-hidden border border-gray-700 rounded">
                            <audio controls class="w-full">
                                <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mpeg">
                                Seu navegador não suporta o elemento de áudio.
                            </audio>
                        </div>

                        <label for="new_song_file" class="block mt-4 mb-2 font-medium">Substituir Arquivo</label>
                        <input type="file" id="new_song_file" name="song_file" accept=".mp3,.wav,.aac"
                            class="w-full p-2 bg-gray-800 border border-gray-700 rounded focus:border-blue-500 focus:outline-none">
                        <p class="mt-1 text-sm text-gray-400">Deixe em branco para manter o arquivo atual</p>
                    </div>
                </div>
            </div>

            <!-- Informações do Álbum -->
            <div class="space-y-4">
                <div class="p-4 bg-gray-800 rounded-lg">
                    <h3 class="mb-2 font-medium">Informações do Álbum</h3>
                    <div class="flex items-center space-x-4">
                        <img src="{{ $album->cover_image ? asset('storage/' . $album->cover_image) : asset('images/default-album.png') }}"
                             class="w-16 h-16 rounded">
                        <div>
                            <p class="font-medium">{{ $album->title }}</p>
                            <p class="text-sm text-gray-400">{{ $album->singer->name }}</p>
                            <p class="text-sm text-gray-400">{{ $album->release_date->format('Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Botões -->
                <div class="flex flex-col gap-3">
                    <button type="submit"
                        class="w-full px-4 py-4 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Atualizar Música
                    </button>
                    <a href="{{ route('admin.albums.show', $album->id) }}"
                        class="w-full px-4 py-5 text-center text-white bg-gray-600 rounded hover:bg-gray-700">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
