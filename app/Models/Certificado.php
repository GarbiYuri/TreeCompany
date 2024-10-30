<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;

    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = [
        'descricao', // A descrição do certificado
        'id_empresa', // A chave estrangeira que referencia a empresa
    ];

    // Relacionamento com empresa (um certificado pertence a uma empresa)
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }
}
