@extends('admin.layouts.app')

@section('title', 'Listagem dos Usuários')

@section('content')
    @include('admin.users.partials.breadcrumb')

    <div class="p-6 text-white bg-gray-900 border border-gray-800 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-indigo-500 dark:text-indigo-400">Usuarios</h2>
            <a href="{{ route('admin.users.create') }}"
            class="flex items-center px-4 py-2 font-bold text-white bg-indigo-600 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <i class="mr-2 fa-solid fa-plus"></i> Novo Usuario
        </a>
        </div>

        {{-- FILTRO --}}
        <form method="GET" class="mb-6">
            <div class="flex flex-col gap-4 sm:flex-row">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Buscar por nome ou e-mail"
                       class="w-full px-4 py-2 text-gray-100 placeholder-gray-400 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium bg-blue-600 rounded hover:bg-blue-700">
                    Filtrar
                </button>
            </div>
        </form>

        <x-alert />

        <div class="overflow-x-auto">
            <table class="w-full overflow-hidden text-sm bg-gray-800 border border-gray-700 rounded-lg">
                <thead class="text-xs text-left text-gray-300 uppercase bg-gray-700">
                    <tr>
                        <th class="px-6 py-3">Nome</th>
                        <th class="px-6 py-3">E-mail</th>
                        <th class="px-6 py-3">Admin</th>
                        <th class="px-6 py-3">Playlists</th>
                        <th class="px-6 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="transition-colors border-t border-gray-700 hover:bg-gray-700">
                            <td class="px-6 py-3">{{ $user->name }}</td>
                            <td class="px-6 py-3 text-gray-300">{{ $user->email }}</td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $user->is_admin ? 'bg-green-600' : 'bg-red-600' }}">
                                    {{ $user->is_admin ? 'Sim' : 'Não' }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                <div x-data="{ openModal: false }" class="flex items-center gap-2">
                                    <span>{{ $user->playlists->count() }} Playlist(s)</span>
                                    <button @click="openModal = true"
                                            class="px-3 py-1 text-sm bg-green-600 rounded hover:bg-green-700">
                                        Ver
                                    </button>

                                    <!-- Modal de Playlists -->
                                    <div x-show="openModal" x-cloak x-transition
                                         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
                                        <div class="w-full max-w-xl p-6 text-white bg-gray-800 rounded-lg shadow-lg">
                                            <h3 class="mb-4 text-lg font-semibold">
                                                Playlists de {{ $user->name }}
                                            </h3>

                                            <ul class="space-y-2 overflow-y-auto max-h-64">
                                                @forelse ($user->playlists as $playlist)
                                                    <li class="flex items-center justify-between px-4 py-2 bg-gray-700 rounded">
                                                        <span>{{ $playlist->title ?? $playlist->name ?? 'Sem título' }}</span>
                                                        <div class="flex gap-2">
                                                            <a href="{{ route('playlists.edit', $playlist->id) }}"
                                                               class="px-3 py-1 text-sm bg-yellow-600 rounded hover:bg-yellow-700">
                                                                Editar
                                                            </a>
                                                            <a href="{{ route('playlists.show', $playlist->id) }}"
                                                               class="px-3 py-1 text-sm bg-blue-600 rounded hover:bg-blue-700">
                                                                Ver
                                                            </a>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li class="px-4 py-2 text-gray-300">Nenhuma playlist encontrada.</li>
                                                @endforelse
                                            </ul>

                                            <div class="mt-6 text-right">
                                                <button @click="openModal = false"
                                                        class="px-4 py-2 text-sm bg-gray-700 rounded hover:bg-gray-600">
                                                    Fechar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="px-4 py-2 text-sm bg-yellow-500 rounded hover:bg-yellow-600">
                                        Editar
                                    </a>
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                       class="px-4 py-2 text-sm bg-blue-500 rounded hover:bg-blue-600">
                                        Detalhes
                                    </a>
                                    <!-- Botão de deletar com modal -->
                                    <div x-data="{ confirmDelete: false }">
                                        <button @click="confirmDelete = true"
                                                class="px-4 py-2 text-sm bg-red-600 rounded hover:bg-red-700">
                                            Excluir
                                        </button>

                                        <div x-show="confirmDelete" x-cloak x-transition
                                             class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
                                            <div class="w-full max-w-sm p-6 text-white bg-gray-800 rounded shadow-lg">
                                                <h2 class="mb-4 text-lg font-semibold">Tem certeza?</h2>
                                                <p class="mb-4 text-sm">Deseja excluir o usuário <strong>{{ $user->name }}</strong>? Esta ação não pode ser desfeita.</p>
                                                <div class="flex justify-end gap-3">
                                                    <button @click="confirmDelete = false"
                                                            class="px-4 py-2 text-sm bg-gray-700 rounded hover:bg-gray-600">
                                                        Cancelar
                                                    </button>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="px-4 py-2 text-sm bg-red-600 rounded hover:bg-red-700">
                                                            Confirmar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fim botão excluir -->
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                                Nenhum usuário encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->appends(['search' => request('search')])->links() }}
        </div>
    </div>
@endsection
