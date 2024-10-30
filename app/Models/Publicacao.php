<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    use HasFactory;

    // Definindo a tabela (caso a convenção plural não seja usada)
    protected $table = 'publicacao';

    // Definindo os campos que podem ser preenchidos
    protected $fillable = [
        'empresa_id',
        'titulo',
        'conteudo'
    ];

    // Relacionamento com Empresa (Uma publicação pertence a uma empresa)
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
    public function imagens()
    {
        return $this->hasMany(FotoPubli::class, 'publicacao_id');
    }
}
