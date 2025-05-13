<x-alert />

@csrf

<div class="space-y-4">
    <input type="text" name="name" placeholder="Nome"
           value="{{ isset($user) ? $user->name : old('name') }}"
           class="w-full px-4 py-2 text-white bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

    <input type="email" name="email" placeholder="Email"
           value="{{ isset($user) ? $user->email : old('email') }}"
           class="w-full px-4 py-2 text-white bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

    <input type="password" name="password" placeholder="Senha"
           class="w-full px-4 py-2 text-white bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

    <!-- Campo is_admin -->
    <div class="flex items-center space-x-3">
        <input type="checkbox" name="is_admin" id="is_admin"
               {{ isset($user) && $user->is_admin ? 'checked' : '' }}
               class="w-5 h-5 text-blue-600 bg-gray-800 border-gray-600 rounded focus:ring-blue-500">
        <label for="is_admin" class="text-sm text-white">Administrador</label>
    </div>
    <p class="text-sm text-gray-400">Marque se o usuário for um administrador.</p>

    <!-- Botões -->
    <div class="grid gap-2 mt-6 md:grid-cols-2">
        <button type="submit"
                class="w-full px-4 py-2 font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
            {{ isset($user) ? 'Atualizar' : 'Cadastrar' }}
        </button>

        <a href="/admin/users"
           class="w-full px-4 py-2 text-center text-white transition-colors bg-gray-700 rounded-lg hover:bg-gray-600">
            Voltar
        </a>
    </div>
</div>
