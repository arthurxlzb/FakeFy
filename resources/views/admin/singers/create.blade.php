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

        
        </div>
    </form>
@endsection
