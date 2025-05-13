@extends('admin.layouts.app')

@section('title', 'Criar novo Usuário')

@section('content')
    @include('admin.users.partials.breadcrumb')

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">Novo Usuário</h2>
        <p class="text-sm text-gray-400">Preencha os dados abaixo para cadastrar um novo usuário.</p>
    </div>

    <div class="p-6 bg-gray-900 border border-gray-700 rounded-lg shadow-md">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @include('admin.users.partials.form')
        </form>
    </div>
@endsection
