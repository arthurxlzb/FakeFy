<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\Album;
use App\Models\Playlist;
use App\Models\Singer;
use App\Models\LikedSong;
use App\Http\Requests\UpdateSongRequest;
use App\Http\Requests\StoreSongRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use getID3;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::with(['singer', 'album'])->latest()->paginate(10);
        return view('admin.songs.index', compact('songs'));
    }

    public function create()
    {
        $singers = Singer::all();
        $albums = Album::with('singer')->get();
        return view('admin.songs.create', compact('singers', 'albums'));
    }

    public function store(StoreSongRequest $request)
    {
        try {
            $file = $request->file('song_file');
            $path = $this->storeSongFile($file);

            if (!Storage::disk('public')->exists($path)) {
                throw new \Exception("Arquivo não foi armazenado corretamente");
            }

            Song::create([
                'title' => $request->title,
                'singer_id' => $request->singer_id,
                'album_id' => $request->album_id,
                'file_path' => $path,
                'duration' => $this->getAudioDuration($file),
                'track_number' => $request->track_number,
            ]);

            return redirect()->route('admin.songs.index')
                ->with('success', 'Música adicionada com sucesso!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro: ' . $e->getMessage());
        }
    }

    public function edit(Song $song)
    {
        $album = $song->album;
        return view('admin.songs.edit', compact('song', 'album'));
    }

    public function update(UpdateSongRequest $request, Song $song)
    {
        try {
            $data = $request->only('title', 'track_number');

            if ($request->has('singer_id') && $request->has('album_id')) {
                $data = array_merge($data, $request->only('singer_id', 'album_id'));
            }

            if ($request->hasFile('song_file')) {
                Storage::disk('public')->delete($song->file_path);
                $file = $request->file('song_file');
                $data['file_path'] = $this->storeSongFile($file);
                $data['duration'] = $this->getAudioDuration($file);
            }

            $song->update($data);

            return redirect()->route('admin.songs.index')
                ->with('success', 'Música atualizada com sucesso!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erro ao atualizar música: ' . $e->getMessage());
        }
    }

    public function destroy(Song $song)
    {
        try {
            Storage::disk('public')->delete($song->file_path);
            $song->delete();

            return redirect()->route('admin.songs.index')
                ->with('success', 'Música removida com sucesso!');

        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover música: ' . $e->getMessage());
        }
    }

    public function createFromAlbum(Album $album)
    {
        return view('admin.songs.create', [
            'album' => $album,
            'singers' => Singer::all(),
            'albums' => Album::with('singer')->get()
        ]);
    }

    public function storeFromAlbum(StoreSongRequest $request, Album $album)
    {
        try {
            $file = $request->file('song_file');
            $path = $this->storeSongFile($file);

            Song::create([
                'title' => $request->title,
                'singer_id' => $album->singer_id,
                'album_id' => $album->id,
                'file_path' => $path,
                'duration' => $this->getAudioDuration($file),
                'track_number' => $request->track_number,
            ]);

            return redirect()->route('admin.albums.show', $album->id)
                ->with('success', 'Música adicionada com sucesso!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erro ao salvar música: ' . $e->getMessage());
        }
    }

    public function editFromAlbum(Album $album, Song $song)
    {
        return view('admin.songs.edit', [
            'song' => $song,
            'album' => $album,
            'singers' => Singer::all(),
            'albums' => Album::with('singer')->get()
        ]);
    }

    public function updateFromAlbum(UpdateSongRequest $request, Album $album, Song $song)
    {
        try {
            $data = $request->only('title', 'track_number');

            if ($request->hasFile('song_file')) {
                Storage::disk('public')->delete($song->file_path);
                $file = $request->file('song_file');
                $data['file_path'] = $this->storeSongFile($file);
                $data['duration'] = $this->getAudioDuration($file);
            }

            $song->update($data);

            return redirect()->route('admin.albums.show', $album->id)
                ->with('success', 'Música atualizada com sucesso!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erro ao atualizar música: ' . $e->getMessage());
        }
    }

    public function destroyFromAlbum(Album $album, Song $song)
    {
        try {
            Storage::disk('public')->delete($song->file_path);
            $song->delete();

            return redirect()->route('admin.albums.show', $album->id)
                ->with('success', 'Música removida com sucesso!');

        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao remover música: ' . $e->getMessage());
        }
    }

    public function likeSong(Song $song)
    {
        $user = auth()->user();

        $likedSong = LikedSong::where('user_id', $user->id)
                              ->where('song_id', $song->id)
                              ->first();

        if ($likedSong) {
            $likedSong->delete();
            $song->decrement('likes');

            $playlist = $user->playlists()->where('title', 'Curtidas')->first();
            if ($playlist) {
                $playlist->songs()->detach($song->id);
            }

            return back()->with('success', 'Você descurtiu esta música.');
        } else {
            LikedSong::create([
                'user_id' => $user->id,
                'song_id' => $song->id,
            ]);
            $song->increment('likes');

            $playlist = $user->playlists()->firstOrCreate(
                ['title' => 'Curtidas'],
                [
                    'description' => 'Suas Músicas Curtidas',
                    'is_public' => false,
                    'user_id' => $user->id
                ]
            );

            if (!$playlist->songs->contains($song->id)) {
                $playlist->songs()->attach($song->id);
            }

            return back()->with('success', 'Você curtiu esta música!');
        }
    }

    protected function getAudioDuration($file)
    {
        try {
            $getID3 = new \getID3;
            $fileInfo = $getID3->analyze($file->getPathname());

            return $fileInfo['playtime_string'] ?? '00:00';
        } catch (\Exception $e) {
            Log::error('Erro ao obter a duração do áudio: ' . $e->getMessage() . ' | Arquivo: ' . $file->getPathname());
            return '00:00';
        }
    }

    protected function storeSongFile($file)
    {
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->extension();
        return $file->storeAs('songs', $filename, 'public');
    }
}
