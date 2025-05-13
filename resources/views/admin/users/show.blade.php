@extends ('admin.layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    <h1 class="mb-2 text-2xl font-bold">Detalhes do Usuário: {{ $user->name }}</h1>

    @include('admin.users.partials.breadcrumb')

    <div class="mt-4 space-y-2 text-sm">
        <p><strong>Nome:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    <x-alert />

    @can('is-admin')
        <div class="flex flex-wrap gap-3 mt-6">
            {{-- Botão voltar --}}
            <a href="{{ route('admin.users.index') }}"
               class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                Voltar
            </a>

            {{-- Botão excluir com modal --}}
            <div x-data="{ confirmDelete: false }">
                <button @click="confirmDelete = true"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">
                    Deletar
                </button>

                {{-- Modal de confirmação --}}
                <div x-show="confirmDelete" x-cloak x-transition
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
                    <div class="w-full max-w-sm p-6 text-white bg-gray-800 rounded shadow-lg">
                        <h2 class="mb-4 text-lg font-semibold">Tem certeza?</h2>
                        <p class="mb-4 text-sm">
                            Deseja excluir o usuário <strong>{{ $user->name }}</strong>?
                            Esta ação não poderá ser desfeita.
                        </p>
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
        </div>
    @endcan
</div>
@endsection
