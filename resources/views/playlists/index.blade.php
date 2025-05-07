@extends('admin.layouts.app')

@section('title', 'Minhas Playlists')

@section('content')

<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Minhas Playlists</h2>

        <a href="{{ route('playlists.create') }}"
            class="flex items-center px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-800">
            <i class="mr-2 fa-solid fa-plus"></i> Nova Playlist
        </a>
    </div>

    <x-alert />

    <div class="overflow-x-auto">
        <table class="min-w-full text-white bg-gray-800 border border-gray-700 rounded-lg">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-6 py-3 text-left">Nome</th>
                    <th class="px-6 py-3 text-left">Usuario</th>
                    <th class="px-6 py-3 text-left">Descrição</th>
                    <th class="px-6 py-3 text-left">Pública</th>
                    <th class="px-6 py-3 text-left">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($playlists as $playlist)
                    <tr class="border-b border-gray-700">
                        <td class="px-6 py-3">{{ $playlist->title }}</td>
                        <td class="px-6 py-3">{{ $playlist->user->name }}</td>
                        <td class="px-6 py-3">{{ $playlist->description }}</td>
                        <td class="px-6 py-3">{{ $playlist->is_public ? 'Sim' : 'Não' }}</td>
                        <td class="flex gap-2 px-6 py-3">
                            <a href="{{ route('playlists.show', $playlist) }}"
                                class="px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">
                                Ver
                            </a>
                            <a href="{{ route('playlists.edit', $playlist) }}"
                                class="px-4 py-2 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center">Nenhuma playlist encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $playlists->links() }}
    </div>
</div>

@endsection
