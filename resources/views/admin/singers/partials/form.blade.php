<x-alert/>

@csrf()

<!-- Nome -->
<input type="text" name="name" placeholder="Nome"
       value="{{ isset($singer) ? $singer->name : old('name') }}"
       class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">

<!-- Gênero Musical -->
<input type="text" name="genre" placeholder="Gênero Musical"
       value="{{ isset($singer) ? $singer->genre : old('genre') }}"
       class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">

<!-- Data de Nascimento -->
<input type="date" name="birth_date"
       value="{{ isset($singer) ? ($singer->birth_date?->format('Y-m-d') ?? '') : old('birth_date') }}"
       class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">

<!-- Gravadora -->
<input type="text" name="label" placeholder="Gravadora"
       value="{{ isset($singer) ? $singer->label : old('label') }}"
       class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">

<!-- Biografia -->
<textarea name="bio" placeholder="Biografia"
          class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white"
          rows="4">{{ isset($singer) ? $singer->bio : old('bio') }}</textarea>

<button type="submit" class="block w-full p-2 text-center text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">
    {{ isset($singer) ? 'Atualizar' : 'Cadastrar' }}
</button>

<a href="/admin/singers" class="block w-full p-2 text-center text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">
    Voltar
  </a>
