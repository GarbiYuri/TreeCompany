<?php

namespace App\Http\Controllers;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\Avaliacao;
class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($empresaId)
    {
        $user =
        // Obtém a empresa pelo ID
        $empresa = Empresa::findOrFail($empresaId);
    
        // Obtém todas as avaliações associadas a essa empresa
        $avaliacoes = $empresa->avaliacoes; // Relacionamento com a tabela de avaliações
    
        // Retorna a view com a empresa e as avaliações
        return view('avaliacoes.veravaliacao', compact('empresa', 'avaliacoes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($empresaId)
{
    // Passa o ID da empresa para o formulário de criação
    return view('avaliacoes.avaliar', compact('empresaId'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $empresaId)
{
    // Valida os dados do formulário
    $request->validate([
        'descricao' => 'required|string|max:255',
        'estrelas' => 'required|integer|min:1|max:5',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validação da foto (opcional)
    ]);

    // Encontra a empresa para verificar se ela é biosustentável
    $empresa = Empresa::findOrFail($empresaId);

    // Limita as estrelas a 3 se a empresa não for biosustentável
    $estrelas = $request->estrelas;
    if (!$empresa->biosustentavel && $estrelas > 3) {
        $estrelas = 3; // Limita a avaliação a no máximo 3 estrelas
    }

    // Verifica se a avaliação é anônima
    $anonimo = $request->has('anonimo') ? 1 : 0;

    // Upload da foto, se houver
    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('avaliacoes_fotos', 'public');
    }

    // Cria uma nova avaliação associada à empresa e ao usuário (ou anônima)
    Avaliacao::create([
        'id_empresa' => $empresaId,
        'id_user' => $anonimo ? null : auth()->id(), // Define id_user como null se for anônima
        'descricao' => $request->descricao,
        'estrelas' => $estrelas, // Utiliza o valor ajustado de estrelas
        'foto' => $fotoPath, // Caminho da foto (se houver)
    ]);

    // Redireciona com mensagem de sucesso
    return redirect()->route('empresas.avaliacoes.index', $empresaId)->with('success', 'Avaliação criada com sucesso!');
}


    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($empresaId, $avaliacaoId)
{
    // Busca a empresa e a avaliação pelos seus IDs
    $empresa = Empresa::findOrFail($empresaId);
    $avaliacao = Avaliacao::findOrFail($avaliacaoId);

    // Retorna a view de edição
    return view('avaliacoes.edit', compact('empresa', 'avaliacao'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $empresaId, $avaliacaoId)
{
    // Valida os dados do formulário
    $request->validate([
        'descricao' => 'required|string|max:255',
        'estrelas' => 'required|integer|min:1|max:5',
    ]);

    // Busca a avaliação a ser atualizada
    $avaliacao = Avaliacao::findOrFail($avaliacaoId);

    // Atualiza os dados da avaliação
    $avaliacao->update([
        'descricao' => $request->descricao,
        'estrelas' => $request->estrelas,
    ]);

    // Redireciona de volta para a página de avaliações com uma mensagem de sucesso
    return redirect()->route('empresas.avaliacoes.index', $empresaId)->with('success', 'Avaliação atualizada com sucesso!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($empresaId, $avaliacaoId)
{
    // Busca a avaliação pelo ID e a exclui
    $avaliacao = Avaliacao::findOrFail($avaliacaoId);
    $avaliacao->delete();

    // Redireciona de volta para a página de avaliações com uma mensagem de sucesso
    return redirect()->route('empresas.avaliacoes.index', $empresaId)->with('success', 'Avaliação excluída com sucesso!');
}

}
