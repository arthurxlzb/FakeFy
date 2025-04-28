@extends ('admin.layouts.app')

@section('title', 'Editar Cantor')

@section('content')

<div class="bg-gray-900 text-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold">Editar Cantor: {{ $singer->name }}</h1>

    @include('admin.singers.partials.breadcrumb')

    <form action="{{ route('admin.singers.update', $singer->id) }}" method="POST" class="mt-4">
        @method('PUT')
        @include('admin.singers.partials.form')
    </form>
</div>

@endsection
