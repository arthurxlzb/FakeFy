@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bem-vindo ao MusicApp</h1>

        <h2>Músicas Populares</h2>
        <ul>
            @foreach($songs as $song)
                <li>
                    <a href="{{ route('song.show', $song->id) }}">{{ $song->title }}</a>
                </li>
            @endforeach
        </ul>

        <h2>Álbuns Recentes</h2>
        <ul>
            @foreach($albums as $album)
                <li>
                    <a href="{{ route('album.show', $album->id) }}">{{ $album->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
