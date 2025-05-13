@extends('admin.layouts.app')

@section('title', 'Criar Novo Álbum')

@section('content')
<div class="p-8 text-white bg-gray-900 rounded-lg shadow-lg">
    @include('admin.albums.partials.breadcrumb', [
        'current' => 'Criar Álbum',
        'singer' => $singer ?? null
    ])

    <h2 class="mb-6 text-3xl font-bold">Adicionar Novo Álbum</h2>

    <form action="{{ isset($singer) ? route('admin.singers.albums.store', $singer) : route('admin.albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div class="md:col-span-2">
                @include('admin.albums.partials.form', [
                    'album' => null,
                    'singers' => $singers,
                    'singer' => $singer ?? null
                ])
            </div>

            <div class="space-y-6">
                <div class="p-6 bg-gray-800 rounded-lg">
                    <h3 class="mb-4 text-xl font-medium">Pré-visualização da Capa</h3>
                    <img id="cover-preview" src="{{ asset('images/default-album.png') }}"
                         class="w-full border-2 border-gray-700 rounded-lg shadow-md">
                </div>

                <div class="flex space-x-4">
                    <button type="submit" class="flex-1 px-4 py-2 rounded-lg btn-primary">
                        <i class="mr-2 fas fa-save"></i> Salvar Álbum
                    </button>
                    <a href="{{ isset($singer) ? route('admin.singers.albums.index', $singer) : route('admin.albums.index') }}" class="px-4 py-2 rounded-lg btn-gray">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.getElementById('cover_image').addEventListener('change', function(e) {
        const preview = document.getElementById('cover-preview');
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    });
</script>
@endpush
@endsection
