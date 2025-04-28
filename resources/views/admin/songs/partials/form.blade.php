<!-- resources/views/admin/songs/partials/form.blade.php -->
@props(['song', 'album'])

<div class="space-y-4">
    <div>
        <label for="title" class="block mb-2 font-medium">Título da Música</label>
        <input type="text" id="title" name="title" value="{{ old('title', $song->title ?? '') }}" required
               class="w-full p-3 bg-gray-800 border border-gray-700 rounded focus:border-blue-500 focus:outline-none">
    </div>

    <div>
        <label for="track_number" class="block mb-2 font-medium">Número da Faixa</label>
        <input type="number" id="track_number" name="track_number" min="1"
               value="{{ old('track_number', $song->track_number ?? '') }}" required
               class="w-full p-3 bg-gray-800 border border-gray-700 rounded focus:border-blue-500 focus:outline-none">
    </div>

    @if(isset($song))
        <div>
            <label class="block mb-2 font-medium">Arquivo Atual</label>
            <audio controls class="w-full mb-4">
                <source src="{{ Storage::url($song->file_path) }}" type="audio/mpeg">
            </audio>
        </div>
    @endif

    <div>
        <label for="song_file" class="block mb-2 font-medium">
            {{ isset($song) ? 'Substituir Arquivo' : 'Arquivo de Áudio' }}
        </label>
        <input type="file" id="song_file" name="song_file" accept=".mp3,.wav,.aac"
               {{ !isset($song) ? 'required' : '' }}
               class="w-full p-2 bg-gray-800 border border-gray-700 rounded focus:border-blue-500 focus:outline-none">
        <p class="mt-1 text-sm text-gray-400">
            {{ isset($song) ? 'Deixe em branco para manter o arquivo atual' : 'Formatos suportados: MP3, WAV, AAC. Tamanho máximo: 20MB' }}
        </p>
    </div>
</div>
