@extends('admin.layouts.app')

@section('title', 'Detalhes do Cantor')

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-indigo-500 dark:text-indigo-400">Detalhes do Cantor: {{ $singer->name }}</h1>

    @includeIf('admin.singers.partials.breadcrumb')

    <ul class="mt-4 space-y-2">
        <li><strong class="text-yellow-400">Nome:</strong> {{ $singer->name }}</li>
        <li><strong class="text-yellow-400">Gênero Musical:</strong> {{ $singer->genre ?? 'Não informado' }}</li>
        <li><strong class="text-yellow-400">Data de Nascimento:</strong>
            @if($singer->birth_date)
                {{ $singer->birth_date->format('d/m/Y') }}
                ({{ $singer->birth_date->age }} anos)
            @else
                Não informada
            @endif
        </li>
        <li><strong class="text-yellow-400">Gravadora:</strong> {{ $singer->label ?? 'Não informada' }}</li>
        <li>
            <strong class="text-yellow-400">Biografia:</strong>
            <p class="mt-1 text-gray-300 whitespace-pre-line">{{ $singer->bio ?? 'Nenhuma biografia cadastrada' }}</p>
        </li>
    </ul>

    <div class="mt-6 space-y-4">
        <a href="{{ route('admin.singers.edit', $singer->id) }}"
           class="block w-full p-2 text-center text-white bg-yellow-600 border border-yellow-500 rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            Editar
        </a>

        @can('is-admin')
        <form action="{{ route('admin.singers.destroy', $singer->id) }}" method="post">
            @csrf
            @method('delete')

            <button type="submit"
                class="block w-full p-2 text-center text-white bg-red-600 border border-red-500 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                Deletar
            </button>
        </form>
        @endcan
    </div>

    <a href="/admin/singers" class="block w-full p-2 text-center text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
        Voltar
    </a>
</div>
@endsection
