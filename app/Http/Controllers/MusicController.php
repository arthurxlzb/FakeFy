<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    public function home()
    {
        $songs = Song::latest()->take(8)->get();
        $albums = Album::latest()->take(4)->get();

        return view('music.home', compact('songs', 'albums'));
    }

    public function search(Request $request)
    {
        $songs = Song::where('title', 'like', '%' . $request->input('query') . '%')->get();
        return view('music.search', compact('songs'));
    }

    public function showSong($song)
    {
        $song = Song::findOrFail($song);
        return view('music.showSong', compact('song'));
    }

    public function showAlbum($album)
    {
        $album = Album::findOrFail($album);
        return view('music.showAlbum', [
            'album' => $album,
            'songs' => $album->songs,
        ]);
    }

    public function autocomplete(Request $request)
    {
        $search = $request->get('query');

        return response()->json([
            'songs' => Song::where('title', 'LIKE', "%{$search}%")->limit(5)->get(['id', 'title']),
            'albums' => Album::where('title', 'LIKE', "%{$search}%")->limit(5)->get(['id', 'title']),
        ]);
    }

    public function editProfile()
    {
        return view('music.EditarPerfil', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $data = $request->only(['name', 'email']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        Auth::user()->update($data);

        return redirect()->route('home')->with('success', 'Perfil atualizado com sucesso!');
    }
}
