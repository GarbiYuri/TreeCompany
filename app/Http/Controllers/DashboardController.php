<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(Request $request)
{
    // Recupera o valor de 'search' e 'sort' da query string
    $search = $request->input('search');
    $sort = $request->query('sort');
    
    // Query base para buscar todas as empresas
    $query = Empresa::query();
    
    // Se houver um valor de pesquisa, aplica o filtro por nome
    if ($search) {
        $query->where('nome', 'like', '%' . $search . '%');
    }
    
    // Aplica ordenação conforme o parâmetro 'sort'
    switch ($sort) {
        case 'name_asc':
            $query->orderBy('nome', 'asc');
            break;
        case 'name_desc':
            $query->orderBy('nome', 'desc');
            break;
        case 'rating_desc':
            // Ordena pelas avaliações, do mais bem avaliado para o pior
            $query->withAvg('avaliacoes', 'estrelas')->orderBy('avaliacoes_avg_estrelas', 'desc');
            break;
        case 'rating_asc':
            // Ordena pelas avaliações, do pior para o melhor
            $query->withAvg('avaliacoes', 'estrelas')->orderBy('avaliacoes_avg_estrelas', 'asc');
            break;
        default:
            // Ordenação padrão (alfabética crescente)
            $query->orderBy('nome', 'asc');
            break;
    }
    
    // Adiciona a cláusula where para filtrar as empresas com status 'aprovado'
$empresas = $query->where('status', 'aprovado')->get();
    

    // Retorna a view com os dados
    return view('dashboard', compact('empresas', 'search'));
}
    public function index2(Request $request)
    {
        // Receber o valor da pesquisa
        $search = $request->input('search');

        // Se a pesquisa existir, filtrar as pessoas pelo NOME
        if ($search) {
            $empresas = Empresa::where('NOME', 'LIKE', "%{$search}%")->get();
        } else {
            // Se não houver pesquisa, listar todas as empresas
            $empresas = Empresa::all();
        }

        // Retornar a view com as empresas (pesquisadas ou todas)
        return view('empresas.index', compact('empresas', 'search'));
    }
    public function userencontrado(Request $request)
    {
        // Receber o valor da pesquisa
        $search = $request->input('search');

        // Se a pesquisa existir, filtrar as empresas pelo NOME
        if ($search) {
            $users = User::where('name', 'LIKE', "%{$search}%")->get();
        } else {
            // Se não houver pesquisa, listar todas as empresas
            $users = User::all();
        }

        // Retornar a view com as empresas (pesquisadas ou todas)
        return view('admin.config', compact('users', 'search'));
    }
}
