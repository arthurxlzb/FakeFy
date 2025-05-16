<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Singer;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class AlbumController extends Controller
{
    public function index(Singer $singer = null)
    {
        $albums = $singer
            ? $singer->albums()->latest()->paginate(10)
            : Album::latest()->paginate(10);

        return view('admin.albums.index', [
            'albums' => $albums,
            'singer' => $singer
        ]);
    }

    public function create(Singer $singer = null)
    {
        return view('admin.albums.create', [
            'singer' => $singer,
            'singers' => Singer::orderBy('name')->get()
        ]);
    }

   public function store(StoreAlbumRequest $request, Singer $singer = null)
{
    $data = $request->validated();

    // Salva a imagem se ela foi enviada
    if ($request->hasFile('cover_image')) {
        $data['cover_image'] = $request->file('cover_image')->store('album_covers', 'public');
    }

    if ($singer) {
        $singer->albums()->create($data);
        return redirect()->route('admin.singers.albums.index', $singer)
            ->with('success', 'Álbum criado com sucesso!');
    }

    Album::create($data);
    return redirect()->route('admin.albums.index')
        ->with('success', 'Álbum criado com sucesso!');
}

    public function show(Album $album)
    {
        return view('admin.albums.show', compact('album'));
    }

    public function edit(Album $album)
    {
        return view('admin.albums.edit', [
            'album' => $album,
            'singers' => Singer::orderBy('name')->get()
        ]);
    }

    public function update(UpdateAlbumRequest $request, Album $album)
{
    $data = $request->validated();

    // Se uma nova imagem foi enviada, armazena e atualiza o caminho
    if ($request->hasFile('cover_image')) {
    // Remove a imagem antiga se existir
    if ($album->cover_image && Storage::disk('public')->exists($album->cover_image)) {
        Storage::disk('public')->delete($album->cover_image);
    }

    $data['cover_image'] = $request->file('cover_image')->store('album_covers', 'public');
}


    $album->update($data);

    return redirect()->route('admin.albums.index')
        ->with('success', 'Álbum atualizado com sucesso!');
}


    public function destroy(Album $album)
    {
        $album->delete();

        return back()->with('success', 'Álbum excluído com sucesso!');
    }

    public function likeAlbum(Album $album)
    {
        $user = auth()->user();

        // Verifica se o usuário já curtiu o álbum
        $alreadyLiked = DB::table('album_likes')
            ->where('user_id', $user->id)
            ->where('album_id', $album->id)
            ->first();

        if ($alreadyLiked) {
            // Remove o like
            DB::table('album_likes')
                ->where('user_id', $user->id)
                ->where('album_id', $album->id)
                ->delete();

            $album->decrement('likes');

            return back()->with('success', 'Você descurtiu este álbum.');
        } else {
            // Adiciona o like
            DB::table('album_likes')->insert([
                'user_id' => $user->id,
                'album_id' => $album->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $album->increment('likes');

            return back()->with('success', 'Você curtiu este álbum!');
        }
    }

}
