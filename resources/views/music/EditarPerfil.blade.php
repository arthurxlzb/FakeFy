@extends ('layouts.app')

@section('title', 'Editar Perfil')

@section('content')

<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold">Editar Perfil</h1>

    <form action="{{ route('profile.update') }}" method="POST" class="mt-4">
        @method('PUT')
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-white">Nome</label>
            <input type="text" name="name" id="name" placeholder="Nome"
                   value="{{ auth()->user()->name }}"
                   class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-white">Email</label>
            <input type="email" name="email" id="email" placeholder="Email"
                   value="{{ auth()->user()->email }}"
                   class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-white">Nova Senha</label>
            <input type="password" name="password" id="password" placeholder="Senha"
                   class="w-full p-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">
            <span class="text-sm text-gray-400">Deixe em branco para manter a senha atual.</span>
        </div>

        <button type="submit" class="w-full p-2 text-white bg-green-600 border border-green-500 rounded-lg">
            Atualizar Perfil
        </button>

        <a href="{{ route('home') }}" class="block w-full p-2 mt-2 text-center text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">
            Voltar
        </a>
    </form>
</div>

@endsection
