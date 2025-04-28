<!-- resources/views/admin/songs/index.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Todas as Músicas')

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Todas as Músicas</h2>
        <a href="{{ route('admin.songs.create') }}"
            class="flex items-center px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-800">
            <i class="mr-2 fa-solid fa-plus"></i> Nova Musica
        </a>
    </div>

    <div class="overflow-x-auto border border-gray-700 rounded-lg">
        <table class="min-w-full bg-gray-800">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-sm font-medium tracking-wider text-left uppercase">TÍTULO</th>
                    <th class="px-6 py-4 text-sm font-medium tracking-wider text-left uppercase">CANTOR</th>
                    <th class="px-6 py-4 text-sm font-medium tracking-wider text-left uppercase">ÁLBUM</th>
                    <th class="px-6 py-4 text-sm font-medium tracking-wider text-left uppercase">DURAÇÃO</th>
                    <th class="px-6 py-4 text-sm font-medium tracking-wider text-left uppercase">PLAYER</th>
                    <th class="px-6 py-4 text-sm font-medium tracking-wider text-left uppercase">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @forelse($songs as $song)
                    <tr class="hover:bg-gray-750">
                        <td class="px-6 py-3">{{ $song->title }}</td>
                        <td class="px-6 py-3">{{ $song->singer->name }}</td>
                        <td class="px-6 py-3">{{ $song->album->title }}</td>
                        <td class="px-6 py-3">{{ $song->duration }}</td>
                        <td class="px-6 py-3">
                            <audio controls>
                                <source src="{{ asset('storage/' . $song->file_path) }}" type="audio/mpeg">
                                Seu navegador não suporta o elemento de áudio.
                            </audio>

                        </td>
                        <td class="flex gap-2 px-6 py-3">
                            <a href="{{ route('admin.songs.edit', $song->id) }}"
                               class="px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                Editar
                            </a>
                            <form action="{{ route('admin.songs.destroy', $song->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600"
                                        onclick="return confirm('Tem certeza que deseja excluir esta música?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center">Nenhuma música encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $songs->links() }}
    </div>
</div>
@endsection
