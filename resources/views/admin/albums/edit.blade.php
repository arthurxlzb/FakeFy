@extends('admin.layouts.app')

@section('title', 'Editar: ' . $album->title)

@section('content')
<div class="p-6 text-white bg-gray-900 rounded-lg shadow-md">
    @include('admin.albums.partials.breadcrumb', [
        'current' => 'Editar'
    ])

    <h2 class="mb-6 text-2xl font-bold">Editar Álbum</h2>

    <form action="{{ route('admin.albums.update', $album->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="md:col-span-2">
                @include('admin.albums.partials.form', [
                    'album' => $album,
                    'singers' => $singers
                ])
            </div>

            <div class="space-y-6">
                <!-- Capa Atual -->
                <div class="p-4 bg-gray-800 rounded-lg">
                    <h3 class="mb-2 font-medium">Capa Atual</h3>
                    <img id="cover-preview"
                         src="{{ $album->cover_image ? asset('storage/' . $album->cover_image) : asset('images/default-album.png') }}"
                         class="w-full border border-gray-700 rounded">
                </div>

                <!-- Botões de ação -->
                <div class="space-y-3">
                    <button type="submit" class="block w-full p-2 text-center text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        Atualizar Álbum
                    </button>

                    <a href="{{ route('admin.albums.index') }}" class="block w-full py-2 mt-1 text-center text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Preview da imagem selecionada
    document.getElementById('cover_image')?.addEventListener('change', function(e) {
        const preview = document.getElementById('cover-preview');
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    });
</script>
@endpush
@endsection
