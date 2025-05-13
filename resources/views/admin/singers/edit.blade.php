@extends ('admin.layouts.app')

@section('title', 'Editar Cantor')

@section('content')
    <div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-400">
            Editar Cantor: {{ $singer->name }}
        </h1>

        @include('admin.singers.partials.breadcrumb')

        <form action="{{ route('admin.singers.update', $singer->id) }}" method="POST" class="mt-4 space-y-6">
            @method('PUT')
            @include('admin.singers.partials.form')

            <div class="mt-4">
                <button type="submit" class="w-full p-4 text-center text-white transition-all duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-400">
                    Atualizar Cantor
                </button>
            </div>
        </form>
    </div>
@endsection
