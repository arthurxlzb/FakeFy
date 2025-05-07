<x-alert />

@csrf()

<input type="text" name="name" placeholder="Nome"
       value="{{ isset($user) ? $user->name : old('name') }}"
       class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">

<input type="email" name="email" placeholder="Email"
       value="{{ isset($user) ? $user->email : old('email') }}"
       class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">

<input type="password" name="password" placeholder="Senha"
       class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">

<!-- Campo is_admin -->
<div class="mt-4">
    <label for="is_admin" class="block text-sm font-medium text-white">Administrador</label>
    <input type="checkbox" name="is_admin" id="is_admin"
           {{ isset($user) && $user->is_admin ? 'checked' : '' }}
           class="p-2 mt-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">
    <span class="text-sm text-gray-400">Marque se o usuário for um administrador.</span>
</div>

<button type="submit" class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">Cadastrar</button>

<a href="/admin/users" class="block w-full p-2 text-center text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">
    Voltar
</a>
