<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DespesasJob implements ShouldQueue
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
        $dados = $service->getDespesas($this->deputadoApiId);

        foreach ($dados['dados'] ?? [] as $item) {
            \App\Models\Despesa::updateOrCreate(
                ['cod_documento' => $item['codDocumento']],
                [
                    'deputado_api_id' => $this->deputadoApiId,
                    'ano' => $item['ano'],
                    'mes' => $item['mes'],
                    'tipo_despesa' => $item['tipoDespesa'],
                    'tipo_documento' => $item['tipoDocumento'],
                    'cod_tipo_documento' => $item['codTipoDocumento'],
                    'data_documento' => $item['dataDocumento'],
                    'numero_documento' => $item['numDocumento'],
                    'valor_documento' => $item['valorDocumento'],
                    'url_documento' => $item['urlDocumento'],
                    'nome_fornecedor' => $item['nomeFornecedor'],
                    'cnpj_cpf_fornecedor' => $item['cnpjCpfFornecedor'],
                    'valor_liquido' => $item['valorLiquido'],
                    'valor_glosa' => $item['valorGlosa'],
                    'num_ressarcimento' => $item['numRessarcimento'] ?? null,
                    'cod_lote' => $item['codLote'],
                    'parcela' => $item['parcela'],
                    'dados_completos' => $item,
                ]
            );
        }
    }

}
