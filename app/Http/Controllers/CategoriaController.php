<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Exibe todas as categorias
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    // Exibe o formulário para criar uma nova categoria
    public function create()
    {
        return view('categorias.create');
    }

    // Armazena a nova categoria no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    // Exibe os detalhes de uma categoria específica
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    // Exibe o formulário para editar uma categoria
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    // Atualiza uma categoria específica
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    // Remove uma categoria
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria deletada com sucesso!');
    }
    public function empresas(Request $request, $id)
    {
        // Obtém a categoria com empresas relacionadas
        $categoria = Categoria::findOrFail($id);
    
        // Inicializa a query para buscar as empresas da categoria
        $empresasQuery = $categoria->empresas();
    
        // Aplicação da pesquisa pelo nome
        if ($request->has('search') && !empty($request->input('search'))) {
            $empresasQuery->where('nome', 'like', '%' . $request->input('search') . '%');
        }
    
        // Ordenação das empresas
        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'name_asc':
                    $empresasQuery->orderBy('nome', 'asc');
                    break;
                case 'name_desc':
                    $empresasQuery->orderBy('nome', 'desc');
                    break;
                case 'rating_desc':
                    $empresasQuery->withAvg('avaliacoes', 'estrelas')->orderBy('avaliacoes_avg_estrelas', 'desc');
                    break;
                case 'rating_asc':
                    $empresasQuery->withAvg('avaliacoes', 'estrelas')->orderBy('avaliacoes_avg_estrelas', 'asc');
                    break;
            }
        }
    
        // Adiciona a cláusula where para filtrar as empresas com status 'aprovado'
        $empresas = $empresasQuery->where('status', 'aprovado')->get();
        
        return view('categorias.empresas', compact('categoria', 'empresas'));
    }
    
}

