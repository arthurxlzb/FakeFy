<!-- resources/views/admin/songs/partials/breadcrumb.blade.php -->

<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li>
            <div class="flex items-center">
                <i class="text-gray-400 fas fa-chevron-right"></i>
                <a href="{{ route('admin.albums.index') }}" class="ml-1 text-sm font-medium text-gray-400 hover:text-white md:ml-2">
                    Álbuns
                </a>
            </div>
        </li>

        @isset($album)
            <li>
                <div class="flex items-center">
                    <i class="text-gray-400 fas fa-chevron-right"></i>
                    <a href="{{ route('admin.albums.show', $album->id) }}" class="ml-1 text-sm font-medium text-gray-400 hover:text-white md:ml-2">
                        {{ \Illuminate\Support\Str::limit($album->title, 20) }}
                    </a>
                </div>
            </li>
        @endisset

        <li aria-current="page">
            <div class="flex items-center">
                <i class="text-gray-400 fas fa-chevron-right"></i>
                <span class="ml-1 text-sm font-medium text-white md:ml-2">
                    @isset($song)
                        Editar Música
                    @else
                        Adicionar Música
                    @endisset
                </span>
            </div>
        </li>
    </ol>
</nav>
