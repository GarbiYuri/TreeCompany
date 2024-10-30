<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    // Define a tabela associada
    protected $table = 'avaliacao';

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = ['id_empresa', 'id_user', 'descricao', 'estrelas', 'foto']; // 'foto' foi adicionado

    // Relacionamento: uma avaliação pertence a uma empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

    // Relacionamento: uma avaliação pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Acessor para pegar a URL completa da foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return null; // Retorna null se não houver foto
    }
}
