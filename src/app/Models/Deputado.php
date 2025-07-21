<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deputado extends Model
{
    use HasFactory;

    protected $fillable = [
        'api_id',
        'nome',
        'sigla_partido',
        'sigla_uf',
        'email',
        'uri_foto',
        'id_legislatura',
        'dados_completos',
        'ultima_atualizacao',
    ];

    protected $casts = [
        'dados_completos' => 'array',
        'ultima_atualizacao' => 'datetime',
    ];

    public function despesas()
    {
        return $this->hasMany(Despesa::class, 'deputado_api_id', 'api_id');
    }

    public function orgaos()
    {
        return $this->hasMany(Orgao::class, 'deputado_api_id', 'api_id');
    }
}