@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultados da Busca</h1>

        <form action="{{ route('search') }}" method="GET">
            <input type="text" name="query" placeholder="Buscar música..." />
            <button type="submit">Buscar</button>
        </form>

        <ul>
            @foreach($songs as $song)
                <li>
                    <a href="{{ route('song.show', $song->id) }}">{{ $song->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
