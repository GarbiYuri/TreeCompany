<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedeSocial extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'redesocial';

    // Atributos que podem ser preenchidos
    protected $fillable = [
        'empresa_id',
        'nome',
        'link',
    ];

    // Relação com a Empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
