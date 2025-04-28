@extends ('admin.layouts.app')

@section('title', 'Criar novo Usuário')

@section('content')
    @include('admin.users.partials.breadcrumb')
    <div class ="py-6">
        <h2 class= "text-xl font-semibold text-yellow-800 dark:text-yellow-200">
    Novo Usuário
         </h2>
    </div>

<h1 class= "text-xl font-semibold text-yellow-800 dark:text-yellow-200">Novo Usuario</h1>
    <form action="{{ route('admin.users.store') }}" method="POST">
    @include('admin.users.partials.form')
    </form>
@endsection
