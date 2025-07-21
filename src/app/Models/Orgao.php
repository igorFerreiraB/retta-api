<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orgao extends Model
{
    use HasFactory;

    protected $fillable = [
        'deputado_api_id',
        'id_orgao',
        'uri_orgao',
        'sigla_orgao',
        'nome_orgao',
        'nome_publicacao',
        'titulo',
        'cod_titulo',
        'data_inicio',
        'data_fim',
        'dados_completos',
    ];

    protected $casts = [
        'dados_completos' => 'array',
        'data_inicio' => 'date',
        'data_fim' => 'date',
    ];

    public function deputado()
    {
        return $this->belongsTo(Deputado::class, 'deputado_api_id', 'api_id');
    }
}