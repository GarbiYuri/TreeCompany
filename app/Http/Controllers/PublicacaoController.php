<?php

namespace App\Http\Controllers;

use App\Models\Publicacao;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FotoPubli; // Certifique-se de ter o modelo das imagens

class PublicacaoController extends Controller
{
    // Exibe uma lista de publicações
    public function index()
    {
        return redirect()->route('empresas.create')->with('success', 'Publicação deletada com sucesso!');
    }

    public function create(Empresa $empresa)
{
    // Passa a empresa diretamente para a view
    return view('publicacoes.create', compact('empresa'));
}

public function store(Request $request)
{
    $request->validate([
        'empresa_id' => 'required|exists:empresa,id',
        'titulo' => 'required|string|max:255',
        'conteudo' => 'required',
        'imagens.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Valida as imagens
    ]);

    // Cria a nova publicação
    $publicacao = Publicacao::create([
        'empresa_id' => $request->empresa_id,
        'titulo' => $request->titulo,
        'conteudo' => $request->conteudo,
    ]);

    // Processo de upload de múltiplas imagens
    if ($request->hasFile('imagens')) {
        foreach ($request->file('imagens') as $imagem) {
            $caminhoImagem = $imagem->store('/', 'public');
            Fotopubli::create([
                'publicacao_id' => $publicacao->id,
                'caminho_imagem' => $caminhoImagem,
            ]);
        }
    }

    return redirect()->route('empresas.create', $request->empresa_id)->with('success', 'Publicação criada com sucesso!');
}

    // Exibe uma única publicação
    public function show($id)
    {
        $publicacao = Publicacao::findOrFail($id);
        return view('publicacoes.show', compact('publicacao'));
    }

    // Exibe o formulário de edição de uma publicação
    public function edit(Publicacao $publicacao)
{
    $empresa = $publicacao->empresa; // Recupera a empresa relacionada à publicação
    return view('publicacoes.edit', compact('publicacao', 'empresa'));
}

    // Atualiza uma publicação existente
public function update(Request $request, Publicacao $publicacao)
{
    // Validação dos campos
    $request->validate([
        'titulo' => 'required|string|max:255',
        'conteudo' => 'required',
        'imagens.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validação das novas imagens
    ]);

    // Atualizando o título e conteúdo da publicação
    $publicacao->update([
        'titulo' => $request->titulo,
        'conteudo' => $request->conteudo,
    ]);

    // Verificando se novas imagens foram enviadas e processando o upload
    if ($request->hasFile('imagens')) {
        foreach ($request->file('imagens') as $imagem) {
            // Salvando cada nova imagem no armazenamento público
            $caminhoImagem = $imagem->store('fotopubli', 'public');
            
            // Relacionando a nova imagem com a publicação
            $publicacao->imagens()->create([
                'caminho_imagem' => $caminhoImagem,
            ]);
        }
    }

    // Redireciona para a listagem de publicações com mensagem de sucesso
    return redirect()->route('publicacoes.index')->with('success', 'Publicação atualizada com sucesso!');
}

    // Remove uma publicação
    public function destroy(Publicacao $publicacao)
{
    $publicacao->delete();
    return redirect()->back()->with('success', 'Publicação excluída com sucesso!');
}
}
