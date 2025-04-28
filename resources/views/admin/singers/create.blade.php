@extends ('admin.layouts.app')

@section('title', 'Adicionar Novo Cantor')

@section('content')
    @includeIf('admin.singers.partials.breadcrumb')
    <div class ="py-6">
        <h2 class="text-xl font-semibold text-yellow-800 dark:text-yellow-200">Novo Cantor</h2>
    </div>

    <form action="{{ route('admin.singers.store') }}" method="POST">
        @csrf
        @includeIf('admin.singers.partials.form')
        
    </form>
@endsection
