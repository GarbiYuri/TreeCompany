<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;

class AdminController extends Controller
{
    /**
     * Exibe a página de administração.
     */
    public function index()
{
    // Busca todos os usuários
    $users = User::all(); // Aqui você pode filtrar empresas e pessoas se precisar
    $empresas = Empresa::all();
    return view('admin.config', compact('users', 'empresas'));
}


    // Tornar usuário administrador
    public function makeAdmin(User $user)
    {
        $user->administrador = true;
        $user->save();

        return redirect()->back()->with('success', 'Usuário agora é um administrador.');
    }
    // Tirar usuário administrador
    public function desmakeAdmin(User $user)
    {
        $user->administrador = false;
        $user->save();

        return redirect()->back()->with('success', 'Usuário não é mais um administrador.');
    }

    // Deletar usuário
    public function deleteUser(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'Usuário deletado com sucesso.');
    }
}


