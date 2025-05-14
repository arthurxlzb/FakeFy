<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlaylistRequest;
use App\Http\Requests\UpdatePlaylistRequest;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::latest()->paginate(10);
        return view('playlists.index', compact('playlists'));
    }

    public function create()
    {
        $users = User::all();
        $songs = Song::all();
        $playlist = null;

        return view('playlists.create', compact('users', 'songs', 'playlist'));
    }

    public function store(StorePlaylistRequest $request)
{
    $data = $request->validated();

    // Garante que is_public será sempre booleano
    $data['is_public'] = $request->has('is_public') && $request->input('is_public');

    // Força que a playlist seja do usuário autenticado
    $data['user_id'] = auth()->id();

    $playlist = Playlist::create($data);
    $playlist->songs()->sync($request->songs ?? []);

    return redirect()->route('playlists.index')->with('success', 'Playlist criada com sucesso!');
}



    public function show(Playlist $playlist)
    {
        return view('playlists.show', compact('playlist'));
    }

    public function edit(Playlist $playlist)
    {
        $users = User::all();
        $songs = Song::all();
        return view('playlists.edit', compact('playlist', 'users', 'songs'));
    }

    public function update(UpdatePlaylistRequest $request, Playlist $playlist)
    {
        $data = $request->validated();
        $data['is_public'] = filter_var($request->input('is_public'), FILTER_VALIDATE_BOOLEAN);

        $playlist->update($data);
        $playlist->songs()->sync($request->songs ?? []);

        return redirect()->route('playlists.index')->with('success', 'Playlist atualizada com sucesso!');
    }

    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
        return redirect()->route('playlists.index')->with('success', 'Playlist removida com sucesso!');
    }

    public function addSong(Playlist $playlist, Song $song)
    {
        $playlist->songs()->attach($song->id);
        return back()->with('success', 'Música adicionada à playlist!');
    }

    public function removeSong(Playlist $playlist, Song $song)
    {
        $playlist->songs()->detach($song->id);
        return back()->with('success', 'Música removida da playlist!');
    }

    public function userPlaylists()
    {
        $user = auth()->user();
        $playlists = $user->playlists()->latest()->get();

        return view('music.playlist', compact('playlists'));
    }


}
