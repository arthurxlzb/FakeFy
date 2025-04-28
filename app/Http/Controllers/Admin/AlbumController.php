<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Singer;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;

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
        
        if ($singer) {
            $album = $singer->albums()->create($data);
            return redirect()->route('admin.singers.albums.index', $singer)
                ->with('success', 'Álbum criado com sucesso!');
        }
        
        $album = Album::create($data);
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
        $album->update($request->validated());
        
        return redirect()->route('admin.albums.index')
            ->with('success', 'Álbum atualizado com sucesso!');
    }

    public function destroy(Album $album)
    {
        $album->delete();
        
        return back()->with('success', 'Álbum excluído com sucesso!');
    }
}