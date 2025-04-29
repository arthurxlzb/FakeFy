@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $song->title }}</h1>
        <p>{{ $song->artist }}</p>
        <p>{{ $song->album->title }}</p>
        <p>{{ $song->duration }}</p>

        <audio controls>
            <source src="{{ asset('storage/songs/' . $song->audio_file) }}" type="audio/mp3">
            Seu navegador não suporta o áudio.
        </audio>
    </div>
@endsection
