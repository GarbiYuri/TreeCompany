<?php

namespace App\Http\Controllers;

use App\Models\RedeSocial;
use App\Models\Empresa;
use Illuminate\Http\Request;

class RedeSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lista todas as redes sociais com a empresa associada
        return redirect()->route('empresas.create')->with('success', 'Publicação deletada com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Empresa $empresa)
    {

        return view('redesocial.create', compact('empresa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'empresa_id' => 'required|exists:empresa,id',
            'nome' => 'required|string|max:255',
            'link' => 'required|url|max:255',
        ]);

        // Cria uma nova rede social
        RedeSocial::create([
            'empresa_id' => $request->empresa_id,
            'nome' => $request->nome,
            'link' => $request->link,
        ]);

        return redirect()->route('empresas.create', $request->empresa_id)->with('success', 'Rede Social criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Exibe detalhes de uma rede social específica
        $redeSocial = RedeSocial::with('empresa')->findOrFail($id);
        return view('redesocial.show', compact('redeSocial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $redeSocial = RedeSocial::findOrFail($id);
    return view('redesocial.edit', compact('redeSocial'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'link' => 'required|url|max:255',
    ]);

    $redeSocial = RedeSocial::findOrFail($id);
    $redeSocial->update([
        'nome' => $request->nome,
        'link' => $request->link,
    ]);

    return redirect()->route('empresas.create', $redeSocial->empresa_id)->with('success', 'Rede Social atualizada com sucesso!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Deleta uma rede social específica
        $redeSocial = RedeSocial::findOrFail($id);
        $redeSocial->delete();

        return redirect()->route('redesocial.index')->with('success', 'Rede Social removida com sucesso!');
    }
}
