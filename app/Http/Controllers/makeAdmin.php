<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class makeAdmin extends Controller
{
    public function makeAdmin(User $user)
{
    $user->administrador = true; // Define como administrador
    $user->save(); // Salva a alteração no banco de dados

    return redirect()->back()->with('success', 'Usuário foi promovido a administrador.');
}
}
