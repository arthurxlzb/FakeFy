<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\Album;
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
    // Métodos para rotas independentes
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
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->extension();
            $path = $file->storeAs('songs', $filename, 'public');

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
        $album = $song->album; // Certifique-se que a relação 'album' está definida em Song
        return view('admin.songs.edit', compact('song', 'album'));
    }

    public function update(UpdateSongRequest $request, Song $song)
    {
        try {
            $data = [
                'title' => $request->title,
                'singer_id' => $request->singer_id,
                'album_id' => $request->album_id,
                'track_number' => $request->track_number,
            ];

            if ($request->hasFile('song_file')) {
                Storage::disk('public')->delete($song->file_path);

                $file = $request->file('song_file');
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->extension();
                $path = $file->storeAs('songs', $filename, 'public');

                $data['file_path'] = $path;
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

    // Métodos para rotas aninhadas (Álbum > Songs)
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
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->extension();
            $path = $file->storeAs('songs', $filename, 'public');

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
            $data = [
                'title' => $request->title,
                'track_number' => $request->track_number,
            ];

            if ($request->hasFile('song_file')) {
                Storage::disk('public')->delete($song->file_path);

                $file = $request->file('song_file');
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->extension();
                $path = $file->storeAs('songs', $filename, 'public');

                $data['file_path'] = $path;
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

    protected function getAudioDuration($file)
    {
        try {
            $getID3 = new \getID3;
            $fileInfo = $getID3->analyze($file->getPathname());

            if (isset($fileInfo['playtime_string'])) {
                return $fileInfo['playtime_string'];
            }

            return '00:00';
        } catch (\Exception $e) {
            Log::error('Erro ao obter a duração do áudio: ' . $e->getMessage() . ' | Arquivo: ' . $file->getPathname());
            return '00:00';
        }
    }

    public function likeSong(Song $song)
{
    // Pega o usuário autenticado
    $user = auth()->user();

    // Verifica se o usuário já curtiu a música
    $likedSong = LikedSong::where('user_id', $user->id)
                          ->where('song_id', $song->id)
                          ->first();

    if ($likedSong) {
        // Se já curtiu, remove o like
        $likedSong->delete();

        // Decrementa o contador de curtidas na música correta
        $song->decrement('likes');

        return back()->with('success', 'Você descurtiu esta música.');
    } else {
        // Se não curtiu, adiciona o like
        LikedSong::create([
            'user_id' => $user->id,
            'song_id' => $song->id,
        ]);

        // Incrementa o contador de curtidas na música correta
        $song->increment('likes');

        return back()->with('success', 'Você curtiu esta música!');
    }
}




}
