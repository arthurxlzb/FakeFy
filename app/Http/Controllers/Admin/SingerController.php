<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSingerRequest;
use App\Http\Requests\UpdateSingerRequest;
use App\Models\Singer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingerController extends Controller
{

    public function __construct()
{
    $this->middleware('auth')->except(['index', 'show']); // Protege tudo exceto listagem e detalhes
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

    public function show(string $id)
    {
        if (!$singer = Singer::find($id)) {
            return redirect()
                ->route('singers.index')
                ->with('error', 'Cantor não encontrado');
        }

        return view('admin.singers.show', compact('singer'));
    }

    public function edit(string $id)
    {
        if (!$singer = Singer::find($id)) {
            return redirect()
                ->route('singers.index')
                ->with('error', 'Cantor não encontrado');
        }

        return view('admin.singers.edit', compact('singer'));
    }

    public function update(UpdateSingerRequest $request, string $id)
    {
        if (!$singer = Singer::find($id)) {
            return back()
                ->with('error', 'Cantor não encontrado');
        }

        $singer->update($request->validated());

        return redirect()
            ->route('admin.singers.index')
            ->with('success', 'Cantor atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        if (!$singer = Singer::find($id)) {
            return redirect()
                ->route('admin.singers.index')
                ->with('error', 'Cantor não encontrado');
        }

        $singer->delete();

        return redirect()
            ->route('admin.singers.index')
            ->with('success', 'Cantor removido com sucesso!');
    }
}
