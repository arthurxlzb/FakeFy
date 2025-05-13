<x-alert/>

@csrf()

<!-- Nome -->
<input type="text" name="name" placeholder="Nome"
       value="{{ isset($singer) ? $singer->name : old('name') }}"
       class="w-full p-4 text-gray-900 transition-all duration-200 bg-gray-100 border rounded-lg shadow-sm dark:text-white dark:bg-gray-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-400">

<!-- Gênero Musical -->
<input type="text" name="genre" placeholder="Gênero Musical"
       value="{{ isset($singer) ? $singer->genre : old('genre') }}"
       class="w-full p-4 text-gray-900 transition-all duration-200 bg-gray-100 border rounded-lg shadow-sm dark:text-white dark:bg-gray-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-400">

<!-- Data de Nascimento -->
<input type="date" name="birth_date"
       value="{{ isset($singer) ? ($singer->birth_date?->format('Y-m-d') ?? '') : old('birth_date') }}"
       class="w-full p-4 text-gray-900 transition-all duration-200 bg-gray-100 border rounded-lg shadow-sm dark:text-white dark:bg-gray-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-400">

<!-- Gravadora -->
<input type="text" name="label" placeholder="Gravadora"
       value="{{ isset($singer) ? $singer->label : old('label') }}"
       class="w-full p-4 text-gray-900 transition-all duration-200 bg-gray-100 border rounded-lg shadow-sm dark:text-white dark:bg-gray-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-400">

<!-- Biografia -->
<textarea name="bio" placeholder="Biografia"
          class="w-full p-4 text-gray-900 transition-all duration-200 bg-gray-100 border rounded-lg shadow-sm dark:text-white dark:bg-gray-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-400"
          rows="4">{{ isset($singer) ? $singer->bio : old('bio') }}</textarea>

<button type="submit" class="block w-full p-4 text-center text-white transition-all duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-700 dark:focus:ring-indigo-500">
    {{ isset($singer) ? 'Atualizar' : 'Cadastrar' }}
</button>

<a href="/admin/singers" class="block w-full p-4 text-center text-gray-900 transition-all duration-200 bg-gray-100 border rounded-lg dark:text-white dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
    Voltar
</a>
