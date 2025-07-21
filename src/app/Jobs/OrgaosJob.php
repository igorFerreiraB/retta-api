<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class OrgaosJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $deputadoApiId) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $service = new \App\Services\DeputadoService();
        $dados = $service->getEventos($this->deputadoApiId);

        foreach ($dados['dados'] ?? [] as $item) {
            \App\Models\Orgao::updateOrCreate(
                ['id_orgao' => $item['idOrgao']],
                [
                    'deputado_api_id' => $this->deputadoApiId,
                    'id_orgao' => $item['idOrgao'],
                    'uri_orgao' => $item['uriOrgao'],
                    'sigla_orgao' => $item['siglaOrgao'],
                    'nome_orgao' => $item['nomeOrgao'],
                    'nome_publicacao' => $item['nomePublicacao'],
                    'titulo' => $item['titulo'],
                    'cod_titulo' => $item['codTitulo'],
                    'data_inicio' => $item['dataInicio'],
                    'data_fim' => $item['dataFim'],
                    'dados_completos' => $item,
                ]
            );
        }
    }
}
