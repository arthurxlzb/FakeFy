@props(['album', 'singers', 'singer' => null])

<div class="space-y-6">
    @if(!$singer)
        <!-- Seleção de Cantor -->
        <div>
            <label for="singer_id" class="block mb-2 font-medium text-gray-300">Cantor *</label>
            <select name="singer_id" id="singer_id" required
                    class="w-full px-3 py-2 text-white bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="" disabled selected>Selecione um cantor</option>
                @foreach($singers as $s)
                    <option value="{{ $s->id }}"
                        {{ old('singer_id', $album->singer_id ?? '') == $s->id ? 'selected' : '' }}>
                        {{ $s->name }}
                    </option>
                @endforeach
            </select>
            @error('singer_id')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
    @else
        <!-- Campo oculto para cantor pré-definido -->
        <input type="hidden" name="singer_id" value="{{ $singer->id }}">
    @endif

    <!-- Título do Álbum -->
    <div>
        <label for="title" class="block mb-2 font-medium text-gray-300">Título do Álbum *</label>
        <input type="text" id="title" name="title" required
               value="{{ old('title', $album->title ?? '') }}"
               class="w-full px-3 py-2 text-white bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500">
        @error('title')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <!-- Data de Lançamento -->
    <div>
        <label for="release_date" class="block mb-2 font-medium text-gray-300">Data de Lançamento *</label>
        <input type="date" id="release_date" name="release_date" required
               value="{{ old('release_date', isset($album->release_date) ? $album->release_date->format('Y-m-d') : '') }}"
               class="w-full px-3 py-2 text-white bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500">
        @error('release_date')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <!-- Capa do Álbum -->
    <div>
        <label for="cover_image" class="block mb-2 font-medium text-gray-300">
            Capa do Álbum
            @if(isset($album) && $album->cover_image)
                <span class="text-sm text-gray-400">(Deixe em branco para manter a atual)</span>
            @endif
        </label>

        @if(isset($album) && $album->cover_image)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $album->cover_image) }}"
                     alt="Capa atual do álbum"
                     class="object-cover w-full h-48 mb-2 border border-gray-600 rounded-md">
            </div>
        @endif

        <input type="file" id="cover_image" name="cover_image" accept="image/*"
               class="w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-blue-600 file:text-white focus:ring-2 focus:ring-blue-500">
        @error('cover_image')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <!-- Descrição -->
    <div>
        <label for="description" class="block mb-2 font-medium text-gray-300">Descrição</label>
        <textarea id="description" name="description" rows="3"
                  class="w-full px-3 py-2 text-white bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $album->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>
</div>
