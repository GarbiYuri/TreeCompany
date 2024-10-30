<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\Empresa;
use Illuminate\Http\Request;

class DenunciaController extends Controller
{
    /**
     * Listar todas as denúncias.
     */
    public function index()
    {
        $denuncias = Denuncia::with('empresa')->get();
        return view('denuncias.index', compact('denuncias'));
    }

    /**
     * Mostrar o formulário para criar uma nova denúncia.
     */
    public function create($empresa_id)
{
    // Pega apenas a empresa que o usuário deseja denunciar
    $empresa = Empresa::findOrFail($empresa_id);

    // Redireciona para a view de criação de denúncia com a empresa selecionada
    return view('denuncias.create', compact('empresa'));
}

    /**
     * Armazenar uma nova denúncia no banco de dados.
     */
    public function store(Request $request)
{
    // Validação dos dados
    $request->validate([
        'empresa_id' => 'required|exists:empresa,id', // Verifica se o ID da empresa existe
        'descricao' => 'required|string|max:255',
    ]);

    // Criação da denúncia
    Denuncia::create([
        'empresa_id' => $request->empresa_id,
        'descricao' => $request->descricao,
    ]);

    return redirect()->route('empresas.show', $request->empresa_id)->with('success', 'Denúncia enviada com sucesso!');
}

    /**
     * Mostrar uma denúncia específica.
     */
    public function show($id)
    {
        $denuncia = Denuncia::with('empresa')->findOrFail($id);
        return view('denuncias.show', compact('denuncia'));
    }

    /**
     * Mostrar o formulário para editar uma denúncia existente.
     */
    public function edit($id)
    {
        $denuncia = Denuncia::findOrFail($id);
        $empresas = Empresa::all();
        return view('denuncias.edit', compact('denuncia', 'empresas'));
    }

    /**
     * Atualizar uma denúncia no banco de dados.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'descricao' => 'required|string|max:255',
        ]);

        // Atualizando a denúncia
        $denuncia = Denuncia::findOrFail($id);
        $denuncia->update([
            'empresa_id' => $request->empresa_id,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('denuncias.index')->with('success', 'Denúncia atualizada com sucesso!');
    }

    /**
     * Excluir uma denúncia do banco de dados.
     */
    public function destroy($id)
    {
        $denuncia = Denuncia::findOrFail($id);
        $denuncia->delete();

        return redirect()->route('denuncias.index')->with('success', 'Denúncia excluída com sucesso!');
    }
}
