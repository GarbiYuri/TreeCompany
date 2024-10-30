<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    // Defina a tabela associada (só é necessário se o nome da tabela for diferente da convenção "empresas")
    protected $table = 'empresa';

    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = [
        'NOME',
        'CNPJ',
        'descricao',
        'categoria_id',
        'status', // Campo de status para controle de aprovação
        'user_id', // Para rastrear quem criou a empresa
        'logo', // Novo campo para a logo
    ];

    // Relacionamento com avaliações (uma empresa pode ter várias avaliações)
    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class, 'id_empresa');
    }

    // Relacionamento com certificados (uma empresa pode ter vários certificados)
    public function certificados()
    {
        return $this->hasMany(Certificado::class, 'id_empresa');
    }

    // Método para calcular a média das avaliações da empresa
    public function mediaAvaliacao()
    {
        return $this->avaliacoes()->avg('estrelas');
    }

    // Relacionamento com categoria (uma empresa pertence a uma categoria)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Relacionamento com usuário (uma empresa foi criada por um usuário)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Método para retornar o caminho completo da logo
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('logos/' . $this->logo); // Caminho público da logo
        }
        return asset('img/default-logo.png'); // Um logo padrão caso a empresa não tenha uma logo
    }
    public function publicacoes()
{
    return $this->hasMany(Publicacao::class, 'empresa_id'); // Supondo que o campo de chave estrangeira seja 'empresa_id'
}
 // Relação com RedeSocial
 public function redesSociais()
 {
     return $this->hasMany(RedeSocial::class, 'empresa_id');
 }
}
