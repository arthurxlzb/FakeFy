@extends('admin.layouts.app')

@section('title', 'Detalhes do Cantor')

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold">Detalhes do Cantor: {{ $singer->name }}</h1>

    @includeIf('admin.singers.partials.breadcrumb')

    <ul class="mt-4 space-y-2">
        <li><strong>Nome:</strong> {{ $singer->name }}</li>
        <li><strong>Gênero Musical:</strong> {{ $singer->genre ?? 'Não informado' }}</li>
        <li><strong>Data de Nascimento:</strong>
            @if($singer->birth_date)
                {{ $singer->birth_date->format('d/m/Y') }}
                ({{ $singer->birth_date->age }} anos)
            @else
                Não informada
            @endif
        </li>
        <li><strong>Gravadora:</strong> {{ $singer->label ?? 'Não informada' }}</li>
        <li>
            <strong>Biografia:</strong>
            <p class="mt-1 text-gray-300 whitespace-pre-line">{{ $singer->bio ?? 'Nenhuma biografia cadastrada' }}</p>
        </li>
    </ul>

    <div class="mt-6 space-y-4">
        <a href="{{ route('admin.singers.edit', $singer->id) }}"
           class="block w-full p-2 text-center text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
            Editar
        </a>

        @can('is-admin')
        <form action="{{ route('admin.singers.destroy', $singer->id) }}" method="post">
            @csrf
            @method('delete')

            <button type="submit"
                class="block w-full p-2 text-center text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                Deletar
            </button>
        </form>
        @endcan
    </div>

    <a href="/admin/singers" class="block w-full p-2 text-center text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white">
        Voltar
      </a>

    </div>
@endsection
