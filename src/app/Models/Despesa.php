<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'deputado_api_id',
        'ano',
        'mes',
        'tipo_despesa',
        'cod_documento',
        'tipo_documento',
        'cod_tipo_documento',
        'data_documento',
        'numero_documento',
        'valor_documento',
        'url_documento',
        'nome_fornecedor',
        'valor_liquido',
        'valor_glosa',
        'num_ressarcimento',
        'cod_lote',
        'parcela',
        'dados_completos',
    ];

    protected $casts = [
        'dados_completos' => 'array',
        'data_documento' => 'date',
    ];

    public function deputado()
    {
        return $this->belongsTo(Deputado::class, 'deputado_api_id', 'api_id');
    }
}