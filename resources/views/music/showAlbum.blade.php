@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $album->title }}</h1>
        <p>Artista: {{ $album->artist }}</p>

        <h2>Músicas do Álbum</h2>
        <ul>
            @foreach($songs as $song)
                <li>
                    <a href="{{ route('song.show', $song->id) }}">{{ $song->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
