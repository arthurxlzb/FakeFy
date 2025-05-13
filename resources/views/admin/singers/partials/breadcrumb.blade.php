@php
    $currentPath = request()->path();
    $pathParts = array_filter(explode('/', $currentPath));

    $customLabels = [
        'admin' => 'Dashboard',
        'singers' => 'Cantores',
        'edit' => 'Editar',
        'create' => 'Cadastrar',
    ];

    $breadcrumbLinks = [];
    $currentUrl = '';

    foreach ($pathParts as $part) {
        $currentUrl .= "/{$part}";
        $label = $customLabels[$part] ?? ucfirst($part);
        $breadcrumbLinks[$label] = $currentUrl;
    }
@endphp

<nav class="flex p-4 mb-8 text-white rounded-lg shadow-md bg-gradient-to-r from-indigo-500 to-indigo-700" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-2">
        <li>
            <a href="{{ url('/') }}" class="text-indigo-200 transition-all duration-200 hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
            </a>
        </li>
        <span class="mx-1 text-indigo-400">/</span>

        @foreach ($breadcrumbLinks as $label => $url)
            @if ($loop->last)
                <li>
                    <span class="text-sm font-semibold">{{ $label }}</span>
                </li>
            @else
                <li>
                    <a href="{{ url($url) }}" class="text-sm font-medium text-indigo-200 transition-all duration-200 hover:text-white">
                        {{ $label }}
                    </a>
                    <span class="mx-1 text-indigo-400">/</span>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
