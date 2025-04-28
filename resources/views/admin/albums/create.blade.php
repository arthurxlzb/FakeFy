@extends('admin.layouts.app')

@section('title', 'Criar Novo Álbum')

@section('content')
<div class="bg-gray-900 text-white p-6 rounded-lg shadow-md">
    @include('admin.albums.partials.breadcrumb', [
        'current' => 'Criar Álbum',
        'singer' => $singer ?? null
    ])

    <h2 class="text-2xl font-bold mb-6">Adicionar Novo Álbum</h2>

    <form action="{{ isset($singer) ? route('admin.singers.albums.store', $singer) : route('admin.albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                @include('admin.albums.partials.form', [
                    'album' => null,
                    'singers' => $singers,
                    'singer' => $singer ?? null
                ])
            </div>
            
            <div class="space-y-4">
                <div class="bg-gray-800 p-4 rounded-lg">
                    <h3 class="font-medium mb-2">Pré-visualização da Capa</h3>
                    <img id="cover-preview" src="{{ asset('images/default-album.png') }}" 
                         class="w-full rounded border border-gray-700">
                </div>
                
                <div class="flex space-x-3">
                    <button type="submit" class="btn-primary flex-1">
                        <i class="fas fa-save mr-2"></i> Salvar Álbum
                    </button>
                    <a href="{{ isset($singer) ? route('admin.singers.albums.index', $singer) : route('admin.albums.index') }}" class="btn-gray">
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