@extends ('admin.layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')

<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold">Detalhes do Usuário: {{ $user->name }}</h1>

    @include('admin.users.partials.breadcrumb')

    <ul class="mt-4 space-y-2">
        <li><strong>Nome:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
    </ul>

    <x-alert />

    @can('is-admin')
        <div class="flex gap-4 mt-4">
            <!-- Botão Deletar -->
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                @csrf
                @method('delete')

                <button type="submit"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300
                    font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700
                    dark:focus:ring-red-800">
                    Deletar
                </button>
            </form>

            <!-- Botão Voltar -->
            <a href="{{ route('admin.users.index') }}"
                class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300
                font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700
                dark:focus:ring-blue-800">
                Voltar
            </a>
        </div>
    @endcan
</div>

@endsection
