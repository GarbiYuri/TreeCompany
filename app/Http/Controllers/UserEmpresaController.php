<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empresa;
use App\Models\UserEmpresa;
use Illuminate\Http\Request;

class UserEmpresaController extends Controller
{
    // Exibe a listagem de usuários e empresas vinculadas
    public function index(Request $request)
    {
        $empresasPendentes = Empresa::where('status', 'pendente')->get();
        $users = User::all();
        $empresas = Empresa::all(); // Todas as empresas

        return view('userempresa.index', compact('users', 'empresas', 'empresasPendentes'));
    }

    // Vincula o usuário a uma empresa
    public function store(Request $request)
    {
        // Valida os dados enviados pelo formulário
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'empresa_id' => 'required|exists:empresa,id',
        ]);

        // Busca o usuário e empresa pelo ID
        $user = User::findOrFail($request->input('user_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));

        // Atualiza o campo 'empresa_id' do usuário com o ID da empresa selecionada
        $user->id_empresa = $request->input('empresa_id');
        $empresa->user_id = $request->input('user_id');
        $user->save();
        $empresa->save();

        // Redireciona de volta com mensagem de sucesso
        return redirect()->route('userempresa.index')->with('success', 'Usuário vinculado à empresa com sucesso.');
    }

    // Remove o vínculo entre um usuário e uma empresa
    public function desvincular($userId)
{
    // Encontra o usuário pelo ID
    $user = User::findOrFail($userId);

    // Verifica se o usuário está vinculado a uma empresa (id_empresa não é null)
    if ($user->id_empresa) {
        // Pega o ID da empresa atual vinculada ao usuário
        $empresaId = $user->id_empresa;

        // Encontra a empresa vinculada
        $empresa = Empresa::findOrFail($empresaId);

        // Remove o vínculo do 'id_user' na tabela 'empresas', definindo-o como NULL
        $empresa->user_id = null;
        $empresa->save();

        // Remove a vinculação no usuário, definindo 'id_empresa' como NULL
        $user->id_empresa = null;
        $user->save();

        // Redireciona com uma mensagem de sucesso, mostrando o ID da empresa desvinculada
        return redirect()->route('userempresa.index')->with('success', "Usuário desvinculado da empresa ID: $empresaId com sucesso.");
    } else {
        // Se o usuário não estiver vinculado a nenhuma empresa, retorna um erro
        return redirect()->route('userempresa.index')->with('error', 'Usuário não está vinculado a nenhuma empresa.');
    }
}


}
