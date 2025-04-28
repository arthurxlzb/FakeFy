<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Exibir a lista de usuários.
     */
    public function index()
    {
        $users = User::paginate(10);
        $users = User::with('playlists')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Mostrar o formulário para criar um novo usuário.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    public function show($id)
    {
    // Localiza o usuário pelo ID
    $user = User::findOrFail($id);

    // Retorna a view com os detalhes do usuário
    return view('admin.users.show', compact('user'));
    }

    /**
     * Salvar um novo usuário no banco.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Mostrar o formulário de edição do usuário.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Atualizar os dados do usuário.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Excluir o usuário.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
