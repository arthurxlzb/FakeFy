@php
    $currentPath = request()->path();
    $pathParts = array_filter(explode('/', $currentPath));

    $customLabels = [
        'admin' => 'Dashboard',
        'users' => 'Usuários',
        'songs' => 'Músicas',
        'albums' => 'Álbuns',
        'singers' => 'Artistas',
        'playlists' => 'Playlists',
        'edit' => 'Editar',
        'create' => 'Novo',
    ];

    $breadcrumbLinks = [];
    $currentUrl = '';

    foreach ($pathParts as $part) {
        $currentUrl .= "/{$part}";
        $label = $customLabels[$part] ?? ucfirst($part);
        $breadcrumbLinks[$label] = $currentUrl;
    }
@endphp

<nav class="flex mb-6 text-sm text-gray-400" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1">
        @foreach ($breadcrumbLinks as $label => $url)
            @if ($loop->first)
                <li class="inline-flex items-center">
                    <a href="{{ url($url) }}" class="inline-flex items-center hover:text-white">
                        <i class="mr-1 text-base fas fa-home"></i>
                        {{ $label }}
                    </a>
                </li>
            @elseif ($loop->last)
                <li class="inline-flex items-center">
                    <span class="mx-2 text-gray-500">/</span>
                    <span class="text-white">{{ $label }}</span>
                </li>
            @else
                <li class="inline-flex items-center">
                    <span class="mx-2 text-gray-500">/</span>
                    <a href="{{ url($url) }}" class="hover:text-white">{{ $label }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
