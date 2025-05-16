@extends('admin.layouts.app')

@section('title', 'Listagem dos Cantores')

@section('content')

<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    <!-- Cabeçalho -->
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold text-indigo-500 dark:text-indigo-400">Cantores</h2>
        <a href="{{ route('admin.singers.create') }}"
            class="flex items-center px-4 py-2 font-bold text-white bg-indigo-600 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <i class="mr-2 fa-solid fa-plus"></i> Novo Cantor
        </a>
    </div>

    <x-alert />

    <!-- Tabela -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-white bg-gray-800 border border-gray-700 rounded-lg">
            <thead>
                <tr class="bg-gray-700">
                    <th class="px-6 py-3 text-left">Nome</th>
                    <th class="px-6 py-3 text-left">Gênero</th>
                    <th class="px-6 py-3 text-left">Nascimento</th>
                    <th class="px-6 py-3 text-left">Gravadora</th>
                    <th class="px-6 py-3 text-left">Biografia</th>
                    <th class="px-6 py-3 text-left">Ações</th>
                    <th class="px-6 py-3 text-left">Álbuns</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($singers as $singer)
                    @php
                        $bioModalId = 'bioModal' . $singer->id;
                        $albumsModalId = 'albumsModal' . $singer->id;
                    @endphp
                    <tr class="border-b border-gray-700">
                        <td class="px-6 py-3">{{ $singer->name }}</td>
                        <td class="px-6 py-3">{{ $singer->genre }}</td>
                        <td class="px-6 py-3">{{ $singer->birth_date?->format('d/m/Y') ?? '-' }}</td>
                        <td class="px-6 py-3">{{ $singer->label ?? '-' }}</td>
                        <td class="px-6 py-3">
                            @if($singer->bio)
                                <div x-data="{ {{ $bioModalId }}: false }" class="flex items-center gap-2">
                                    <button @click="{{ $bioModalId }} = true"
                                        class="px-3 py-1 text-xs text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        Ver Biografia
                                    </button>

                                    <!-- Modal Biografia -->
                                    <div x-show="{{ $bioModalId }}" x-cloak x-transition
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
                                        <div class="w-full max-w-xl p-6 bg-gray-800 rounded-lg shadow-lg">
                                            <h3 class="mb-4 text-lg font-bold text-white">Biografia de {{ $singer->name }}</h3>
                                            <p class="text-white">{{ $singer->bio }}</p>

                                            <div class="mt-6 text-right">
                                                <button @click="{{ $bioModalId }} = false"
                                                    class="px-4 py-2 text-sm text-white bg-gray-700 rounded hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                                    Fechar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.singers.edit', $singer->id) }}"
                                    class="px-4 py-2 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                    Editar
                                </a>
                                <a href="{{ route('admin.singers.show', $singer->id) }}"
                                    class="px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Detalhes
                                </a>
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            <div x-data="{ {{ $albumsModalId }}: false }" class="flex items-center gap-2">
                                <button @click="{{ $albumsModalId }} = true"
                                    class="px-3 py-1 text-xs text-white bg-green-600 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    Álbuns ({{ $singer->albums->count() }})
                                </button>

                                <!-- Modal Álbuns -->
                                <div x-show="{{ $albumsModalId }}" x-cloak x-transition
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
                                    <div class="w-full max-w-xl p-6 bg-gray-800 rounded-lg shadow-lg">
                                        <h3 class="mb-4 text-lg font-bold text-white">Álbuns de {{ $singer->name }}</h3>

                                        <ul class="space-y-2 overflow-y-auto max-h-64">
                                            @forelse ($singer->albums as $album)
                                                <li class="flex items-center justify-between px-4 py-2 bg-gray-700 rounded">
                                                    <span>{{ $album->title ?? 'Título não disponível' }}</span>
                                                    <div class="flex gap-2">
                                                        <a href="{{ route('admin.albums.edit', $album->id) }}"
                                                            class="px-3 py-1 text-sm text-white bg-yellow-600 rounded hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">Editar</a>
                                                        <a href="{{ route('admin.albums.show', $album->id) }}"
                                                            class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Ver</a>
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="px-4 py-2 text-gray-300">Nenhum álbum encontrado.</li>
                                            @endforelse
                                        </ul>

                                        <div class="mt-6 text-right">
                                            <button @click="{{ $albumsModalId }} = false"
                                                class="px-4 py-2 text-sm text-white bg-gray-700 rounded hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                                Fechar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center">Nenhum cantor encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="mt-4">
        {{ $singers->links() }}
    </div>
</div>

@endsection

{{-- Partial dos modais foi removido porque os modais estão no próprio loop --}}
