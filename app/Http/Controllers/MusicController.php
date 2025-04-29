<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    // Método para a página inicial (Home)
    public function home()
    {
        // Aqui você pode recuperar as músicas ou álbuns mais populares, por exemplo
        $songs = Song::latest()->take(10)->get(); // Exemplo: pegar as 10 músicas mais recentes
        $albums = Album::latest()->take(5)->get(); // Exemplo: pegar os 5 álbuns mais recentes

        return view('music.home', compact('songs', 'albums')); // Passando para a view
    }

    // Método para buscar músicas
    public function search(Request $request)
    {
        $query = $request->input('query');
        $songs = Song::where('title', 'like', "%{$query}%")->get(); // Busca por título da música

        return view('music.search', compact('songs')); // Passando as músicas encontradas
    }

    // Método para exibir a página de uma música específica
    public function showSong($song)
    {
        $song = Song::findOrFail($song); // Encontrar a música ou retornar 404 caso não exista
        return view('music.showSong', compact('song')); // Passando a música para a view
    }

    // Método para exibir a página de um álbum específico
    public function showAlbum($album)
    {
        $album = Album::findOrFail($album); // Encontrar o álbum ou retornar 404 caso não exista
        $songs = $album->songs; // Supondo que um álbum tenha muitas músicas (relação one-to-many)
        return view('music.showAlbum', compact('album', 'songs')); // Passando o álbum e suas músicas para a view
    }
}
