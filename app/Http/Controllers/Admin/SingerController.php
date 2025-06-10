<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSingerRequest;
use App\Http\Requests\UpdateSingerRequest;
use App\Models\Singer;

class SingerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $singers = Singer::orderBy('name')->paginate(15);
        return view('admin.singers.index', compact('singers'));
    }

    public function create()
    {
        return view('admin.singers.create');
    }

    public function store(StoreSingerRequest $request)
    {
        Singer::create($request->validated());

        return redirect()
            ->route('admin.singers.index')
            ->with('success', 'Cantor cadastrado com sucesso!');
    }

    public function show(Singer $singer)
    {
        return view('admin.singers.show', compact('singer'));
    }

    public function edit(Singer $singer)
    {
        return view('admin.singers.edit', compact('singer'));
    }

    public function update(UpdateSingerRequest $request, Singer $singer)
    {
        $singer->update($request->validated());

        return redirect()
            ->route('admin.singers.index')
            ->with('success', 'Cantor atualizado com sucesso!');
    }

    public function destroy(Singer $singer)
    {
        $singer->delete();

        return redirect()
            ->route('admin.singers.index')
            ->with('success', 'Cantor removido com sucesso!');
    }
}
