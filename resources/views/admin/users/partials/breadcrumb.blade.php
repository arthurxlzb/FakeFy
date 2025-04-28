@php
    $currentPath = request()->path();
    $pathParts = array_filter(explode('/', $currentPath));

    $customLabels = [
        'admin' => 'Dashboard',
        'users' => 'Usuários',
        'edit' => 'Editar',
    ];

    $breadcrumbLinks = [];
    $currentUrl = '';

    foreach ($pathParts as $part) {
        $currentUrl .= "/{$part}";
        $label = $customLabels[$part] ?? ucfirst($part);
        $breadcrumbLinks[$label] = $currentUrl;
    }
@endphp

<nav class="flex mb-8" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-2">
        @foreach ($breadcrumbLinks as $label => $url)
            @if ($loop->last)
                <li>
                    <span class="text-sm font-medium text-gray-400">{{ $label }}</span>
                </li>
            @else
                <li>
                    <a href="{{ url($url) }}" class="text-sm font-medium text-blue-400 hover:text-blue-600">
                        {{ $label }}
                    </a>
                    <span class="mx-1 text-gray-400">/</span>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
