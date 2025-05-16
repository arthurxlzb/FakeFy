<?php

namespace App\Http\Controllers;


use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    // Método para exibir a página inicial
    public function home()
    {
        $songs = Song::latest()->take(5)->get();
        $albums = Album::latest()->take(3)->get();
        return view('music.home', compact('songs', 'albums'));
    }

    // Método de busca de músicas
    public function search(Request $request)
    {
        $query = $request->input('query');
        $songs = Song::where('title', 'like', "%{$query}%")->get();
        return view('music.search', compact('songs'));
    }

    // Exibir uma música específica
    public function showSong($song)
    {
        $song = Song::findOrFail($song);
        return view('music.showSong', compact('song'));
    }

    // Exibir um álbum específico
    public function showAlbum($album)
    {
        $album = Album::findOrFail($album);
        $songs = $album->songs;
        return view('music.showAlbum', compact('album', 'songs'));
    }

    // Autocomplete da busca
    public function autocomplete(Request $request)
    {
        $search = $request->get('query');

        $songs = Song::where('title', 'LIKE', "%{$search}%")
            ->limit(5)
            ->get(['id', 'title']);

        $albums = Album::where('title', 'LIKE', "%{$search}%")
            ->limit(5)
            ->get(['id', 'title']);

        return response()->json([
            'songs' => $songs,
            'albums' => $albums,
        ]);
    }

    // **Novo método para exibir a página de edição do perfil**
    public function editProfile()
    {
        return view('music.EditarPerfil', ['user' => Auth::user()]);
    }

    // **Novo método para atualizar o perfil do usuário**
    public function updateProfile(Request $request)
{
    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // Se a senha foi informada, atualiza também
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $user = Auth::user();
    $user->update($data);

    return redirect()->route('home')->with('success', 'Perfil atualizado com sucesso!');
}


}
