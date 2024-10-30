<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoPubli extends Model
{
    protected $table = 'fotopubli';

    use HasFactory;

    protected $fillable = [
        'publicacao_id',
        'caminho_imagem',
    ];

    public function publicacao()
    {
        return $this->belongsTo(Publicacao::class, 'publicacao_id');
    }
}
