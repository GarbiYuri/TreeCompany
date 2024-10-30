<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    protected $fillable = ['nome'];

    // Relacionamento com Empresas
    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'categoria_id');
    }
}

