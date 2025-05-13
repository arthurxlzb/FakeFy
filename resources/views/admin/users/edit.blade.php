@extends('admin.layouts.app')

@section('title', 'Editar Usuário')

@section('content')
    @include('admin.users.partials.breadcrumb')

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">Editar Usuário</h2>
        <p class="text-sm text-gray-400">Atualize as informações do usuário <strong>{{ $user->name }}</strong>.</p>
    </div>

    <div class="p-6 bg-gray-900 border border-gray-700 rounded-lg shadow-md">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
            @method('PUT')
            @include('admin.users.partials.form')
        </form>
    </div>
@endsection
