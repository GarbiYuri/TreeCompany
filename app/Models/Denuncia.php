<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    // Definindo a tabela associada ao modelo
    protected $table = 'denuncia';

    // Definindo os campos que podem ser preenchidos (mass assignment)
    protected $fillable = [
        'empresa_id',
        'descricao',
    ];

    // Relacionamento com o modelo Empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
