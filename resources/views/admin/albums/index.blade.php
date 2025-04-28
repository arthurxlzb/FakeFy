@extends('admin.layouts.app')

@section('title', 'Listagem de Álbuns')

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    @include('admin.albums.partials.breadcrumb')
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Álbuns</h2>
        <a href="{{ route('admin.albums.create') }}"
            class="flex items-center px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-800">
            <i class="mr-2 fa-solid fa-plus"></i> Novo Album
        </a>
    </div>

    <div class="overflow-x-auto border border-gray-700 rounded-lg">
        <table class="min-w-full bg-gray-800">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-sm font-medium tracking-wider text-left uppercase">TÍTULO</th>
                    <th class="px-6 py-4 text-sm font-medium tracking-wider text-left uppercase">CANTOR</th>
                    <th class="px-6 py-4 text-sm font-medium tracking-wider text-left uppercase">ANO</th>
                    <th class="px-6 py-4 text-sm font-medium tracking-wider text-left uppercase">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @forelse($albums as $album)
                    <tr>
                        <td class="px-6 py-3">{{ $album->title }}</td>
                        <td class="px-6 py-3">{{ $album->singer->name }}</td>
                        <td class="px-6 py-3">{{ $album->release_date->format('d/m/Y') }}</td>
                        <td class="flex gap-2 px-6 py-3">
                            <a href="{{ route('admin.albums.edit', $album->id) }}"
                               class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                Editar
                            </a>
                            <a href="{{ route('admin.albums.show', $album->id) }}"
                               class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                                Detalhes
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center">Nenhum álbum encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
