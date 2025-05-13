@extends ('admin.layouts.app')

@section('title', 'Adicionar Novo Cantor')

@section('content')
    @includeIf('admin.singers.partials.breadcrumb')

    <div class="py-6">
        <h2 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-400">Novo Cantor</h2>
    </div>

    <form action="{{ route('admin.singers.store') }}" method="POST" class="space-y-6">
        @csrf
        @includeIf('admin.singers.partials.form')

        <div class="mt-4">
            <button type="submit" class="w-full p-4 text-center text-white transition-all duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 dark:focus:ring-indigo-400">
                Cadastrar Cantor
            </button>
        </div>
    </form>
@endsection
