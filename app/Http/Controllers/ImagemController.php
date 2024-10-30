<?php

namespace App\Http\Controllers;
use App\Models\FotoPubli;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ImagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $imagem = FotoPubli::findOrFail($id);
    
    // Delete the image from storage
    Storage::disk('public')->delete('fotopubli/' . $imagem->caminho_imagem);
    
    // Delete the image record from the database
    $imagem->delete();

    return redirect()->back()->with('success', 'Imagem removida com sucesso!');
}
}
