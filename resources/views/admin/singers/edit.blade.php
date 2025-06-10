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

            
        </form>
    </div>
@endsection
