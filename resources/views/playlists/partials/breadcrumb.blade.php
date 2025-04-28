@php
    $links = [
        ['url' => route('home'), 'label' => 'Início'],
        ['url' => route('playlists.index'), 'label' => 'Minhas Playlists'],
        ['label' => $current ?? '']
    ];
@endphp

<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-2">
        @foreach($links as $link)
            @if(isset($link['url']))
                <li>
                    <a href="{{ $link['url'] }}" class="text-blue-400 hover:text-blue-300">
                        {{ $link['label'] }}
                    </a>
                    <span class="mx-1 text-gray-500">/</span>
                </li>
            @else
                <li class="text-gray-400">{{ $link['label'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>