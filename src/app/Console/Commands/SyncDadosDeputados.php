<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncDadosDeputados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:dados-deputados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para importar os deputados e sincronizar os dados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = new \App\Services\DeputadoService();
        $response = $service->getDeputados();

        foreach ($response['dados'] ?? [] as $item) {
            \App\Models\Deputado::updateOrCreate(
                ['api_id' => $item['id']],
                [
                    'nome' => $item['nome'],
                    'sigla_partido' => $item['siglaPartido'] ?? null,
                    'sigla_uf' => $item['siglaUf'] ?? null,
                    'email' => $item['email'] ?? null,
                    'uri_foto' => $item['urlFoto'] ?? null,
                    'id_legislatura' => $item['idLegislatura'] ?? null,
                    'dados_completos' => $item,
                    'ultima_atualizacao' => now(),
                ]
            );
        }

        $deputados = \App\Models\Deputado::pluck('api_id');

        foreach ($deputados as $id) {

            \App\Jobs\DespesasJob::dispatch($id);
            \App\Jobs\OrgaosJob::dispatch($id);
        }

        $this->info("Jobs de sincronização despachados!");
    }
}
