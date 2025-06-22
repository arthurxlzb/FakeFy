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

        return view('admin.albums.index', compact('albums', 'singer'));
    }

    public function create(Singer $singer = null)
    {
        $singers = Singer::orderBy('name')->get();

        return view('admin.albums.create', compact('singer', 'singers'));
    }

    public function store(StoreAlbumRequest $request, Singer $singer = null)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('album_covers', 'public');
        }

        $album = $singer
            ? $singer->albums()->create($data)
            : Album::create($data);

        return redirect()
            ->route($singer ? 'admin.singers.albums.index' : 'admin.albums.index', $singer)
            ->with('success', 'Álbum criado com sucesso!');
    }

    public function show(Album $album)
    {
        return view('admin.albums.show', compact('album'));
    }

    public function edit(Album $album)
    {
        $singers = Singer::orderBy('name')->get();

        return view('admin.albums.edit', compact('album', 'singers'));
    }

    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            if ($album->cover_image && Storage::disk('public')->exists($album->cover_image)) {
                Storage::disk('public')->delete($album->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')->store('album_covers', 'public');
        }

        $album->update($data);

        return redirect()
            ->route('admin.albums.index')
            ->with('success', 'Álbum atualizado com sucesso!');
    }

    public function destroy(Album $album)
    {
        if ($album->cover_image && Storage::disk('public')->exists($album->cover_image)) {
            Storage::disk('public')->delete($album->cover_image);
        }

        $album->delete();

        return back()->with('success', 'Álbum excluído com sucesso!');
    }

    public function likeAlbum(Album $album)
    {
        $user = auth()->user();

        if ($album->isLikedBy($user)) {
            $album->likedByUsers()->detach($user->id);
            $album->decrement('likes');
            $message = 'Você descurtiu este álbum.';
        } else {
            $album->likedByUsers()->attach($user->id);
            $album->increment('likes');
            $message = 'Você curtiu este álbum!';
        }

        return back()->with('success', $message);
    }

}
