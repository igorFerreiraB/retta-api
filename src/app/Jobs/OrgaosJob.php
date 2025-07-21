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
        $dados = $service->getEventos($this->deputadoId);

        foreach ($dados['dados'] ?? [] as $item) {
            \App\Models\Orgao::updateOrCreate(
                ['id_orgao' => $item['idOrgao']],
                [
                    'deputado_api_id' => $this->deputadoId,
                    'sigla_orgao' => $item['siglaOrgao'],
                    'nome_orgao' => $item['nomeOrgao'],
                    'data_inicio' => $item['dataInicio'],
                    'data_fim' => $item['dataFim'],
                    'dados_completos' => $item,
                ]
            );
        }
    }
}
