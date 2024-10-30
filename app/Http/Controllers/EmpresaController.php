<?php

namespace App\Http\Controllers;
use App\Models\Empresa;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Certificado;
use App\Models\Publicacao;

class EmpresaController extends Controller
{
   // Exibe a lista de empresas
public function index(Request $request)
{
    // Recupera o valor de 'search' e 'sort' da query string
    $search = $request->input('search');
    $sort = $request->query('sort');
    
    // Query base para buscar todas as empresas com status 'aprovado'
    $query = Empresa::where('status', 'aprovado');
    
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
    
    // Recupera as empresas após a aplicação dos filtros de pesquisa e ordenação
    $empresas = $query->get();
    
    // Retorna a view com os dados
    return view('dashboard', compact('empresas', 'search'));
}

public function toggleBiosustentavel($id)
{
    // Encontra a empresa pelo ID
    $empresa = Empresa::findOrFail($id);

    // Alterna o status de 'biosustentavel'
    $empresa->biosustentavel = !$empresa->biosustentavel;
    $empresa->save();

    // Redireciona de volta com uma mensagem de sucesso
    return redirect()->route('empresas.index')->with('success', 'Status de biosustentabilidade atualizado com sucesso!');
}
     // Exibe o formulário de criação de empresa ou o painel da empresa do usuário autenticado
     public function create()
{
    // Recupera o usuário autenticado
    $user = auth()->user();

    // Verifica se o usuário tem uma empresa
    if ($user->id_empresa) {
        // Se o usuário tem uma empresa, recupera a empresa, suas avaliações, certificados e publicações com imagens
        // Ordenando as publicações pela data de criação, das mais recentes para as mais antigas
        $empresa = Empresa::with([
            'avaliacoes', 
            'certificados', 
            'publicacoes' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Ordena as publicações pela data de criação, mais recentes primeiro
            },
            'publicacoes.imagens'
        ])->find($user->id_empresa);

        return view('empresas.painel', compact('empresa'));
    }

    // Se o usuário não tem uma empresa, exibe o formulário de criação
    $categorias = Categoria::all();
    return view('empresas.create', compact('categorias'));
}
     
 
     // Armazena uma nova empresa
     public function store(Request $request)
{
    // Validação dos dados enviados
    $request->validate([
        'NOME' => 'required|string|max:255',
        'CNPJ' => 'required|string|max:18',
        'descricao' => 'required|string',
        'categoria_id' => 'required|exists:categoria,id',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048' // Validação para a logo
    ]);

    // Upload da logo
    if ($request->hasFile('logo')) {
        $logoName = time() . '.' . $request->logo->extension();
        $request->logo->move(public_path('logos'), $logoName);
    }

    // Criação da empresa
    $empresa = Empresa::create([
        'NOME' => $request->NOME,
        'CNPJ' => $request->CNPJ,
        'descricao' => $request->descricao,
        'categoria_id' => $request->categoria_id,
        'logo' => $logoName ?? null, // Guarda o nome do arquivo da logo ou null se não houver
    ]);

    // Vincula o usuário autenticado à empresa recém-criada
    $user = auth()->user();
    $user->id_empresa = $empresa->id; // Associa o ID da empresa criada ao usuário
    $user->save(); // Salva as mudanças no usuário

    return redirect()->route('empresas.index')->with('success', 'Empresa criada e vinculada com sucesso!');
}



    // Exibe os detalhes de uma empresa
    public function show(Empresa $empresa)
    {
        return view('empresas.show', compact('empresa'));
    }

    // Exibe o formulário para editar uma empresa
    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'NOME' => 'required|string|max:255',
            'CNPJ' => 'required|string|max:18',
            'descricao' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048', // Validação para o arquivo de imagem
        ]);
    
        // Encontrar a empresa no banco de dados
        $empresa = Empresa::findOrFail($id);
    
        // Processar a logo, se houver upload de arquivo
        if ($request->hasFile('logo')) {
            // Apagar a logo antiga, se existir
            if ($empresa->logo && file_exists(public_path('logos/' . $empresa->logo))) {
                unlink(public_path('logos/' . $empresa->logo));
            }
    
            // Salvar a nova logo
            $logoName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('logos'), $logoName);
    
            // Atualizar o campo 'logo' no banco de dados
            $empresa->logo = $logoName;
        }
    
        // Atualizar os outros dados
        $empresa->NOME = $request->NOME;
        $empresa->CNPJ = $request->CNPJ;
        $empresa->descricao = $request->descricao;
    
        // Salvar as alterações
        $empresa->save();
    
        return redirect()->route('empresas.create', $empresa->id)->with('success', 'Empresa atualizada com sucesso!');
    }
    

    // Deleta uma empresa
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return redirect()->route('empresas.index')->with('success', 'Empresa deletada com sucesso.');
    }

    public function solicitar(Request $request)
{
    $request->validate([
        'NOME' => 'required|string|max:255',
        'CNPJ' => 'required|string|max:14',
        'descricao' => 'required|string',
        'categoria_id' => 'required|exists:categoria,id',
    ]);

    // Salvar solicitação de empresa (com status 'pendente')
    Empresa::create([
        'NOME' => $request->NOME,
        'CNPJ' => $request->CNPJ,
        'descricao' => $request->descricao,
        'categoria_id' => $request->categoria_id,
        'status' => 'pendente', // Adiciona status de pendente
        'user_id' => auth()->user()->id, // Relaciona com o usuário que fez a solicitação
    ]);

    return redirect()->back()->with('success', 'Solicitação enviada para aprovação.');
}

public function aprovar($empresaId)
{
    // Encontra a empresa pelo ID
    $empresa = Empresa::findOrFail($empresaId);

    // Verifica se o status da empresa está 'pendente'
    if ($empresa->status === 'pendente') {
        // Altera o status para 'aprovado'
        $empresa->status = 'aprovado';
        $empresa->save();

        // Redireciona de volta com mensagem de sucesso
        return redirect()->route('userempresa.index')->with('success', 'Empresa aprovada com sucesso.');
    } else {
        // Se a empresa já estiver aprovada ou tiver outro status, retorna uma mensagem de erro
        return redirect()->route('userempresa.index')->with('error', 'A empresa já foi aprovada ou está em outro status.');
    }
}

}
