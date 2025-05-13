@extends ('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="p-6 text-white bg-gray-800 rounded-lg shadow-md">
    <h1 class="text-3xl font-semibold">Editar Perfil</h1>

    <form action="{{ route('profile.update') }}" method="POST" class="mt-6 space-y-6">
        @method('PUT')
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nome</label>
            <input type="text" name="name" id="name" placeholder="Nome"
                   value="{{ auth()->user()->name }}"
                   class="w-full p-3 text-white bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" placeholder="Email"
                   value="{{ auth()->user()->email }}"
                   class="w-full p-3 text-white bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Nova Senha</label>
            <input type="password" name="password" id="password" placeholder="Senha"
                   class="w-full p-3 text-white bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500">
            <span class="text-sm text-gray-400">Deixe em branco para manter a senha atual.</span>
        </div>

        <div class="flex justify-between space-x-4">
            <button type="submit" class="w-full p-3 text-white transition duration-200 bg-green-600 rounded-lg sm:w-auto hover:bg-green-700">
                Atualizar Perfil
            </button>
            <a href="{{ route('home') }}" class="w-full p-3 text-center text-gray-700 transition duration-200 bg-white rounded-lg sm:w-auto dark:bg-gray-800 dark:text-white hover:bg-gray-200">
                Voltar
            </a>
        </div>
    </form>
</div>
@endsection
