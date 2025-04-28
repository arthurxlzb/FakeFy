@extends ('admin.layouts.app')

@section('title', 'Editar Usuário')

@section('content')

<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold">Editar Usuário: {{ $user->name }}</h1>

    @include('admin.users.partials.breadcrumb')

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="mt-4">
        @method('PUT')
        @include('admin.users.partials.form')
    </form>
</div>

@endsection
