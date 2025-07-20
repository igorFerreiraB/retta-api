<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class DeputadoService
{
    /**
     * URL base da API da Câmara dos Deputados
     */
    protected string $baseUrl = 'https://dadosabertos.camara.leg.br/api/v2';

    /**
     * Obtém a lista de todos os deputados
     * 
     * @return array Resposta da API com a lista de deputados
     */
    public function getDeputados(): array
    {
        return Http::get("{$this->baseUrl}/deputados")->json();
    }

    /**
     * Obtém os detalhes de um deputado específico pelo ID
     * 
     * @param int $id ID do deputado
     * @return array Resposta da API com os dados do deputado
     */
    public function getDeputado($id): array
    {
        return Http::get("{$this->baseUrl}/deputados/{$id}")->json();
    }

    /**
     * Obtém as despesas de um deputado específico
     * 
     * @param int $id ID do deputado
     * @return array Resposta da API com as despesas do deputado
     */
    public function getDespesas($id): array
    {
        return Http::get("{$this->baseUrl}/deputados/{$id}/despesas")->json();
    }

    /**
     * Obtém os órgãos e comissões que o deputado participa
     * 
     * @param int $id ID do deputado
     * @return array Resposta da API com os órgãos do deputado
     */
    public function getEventos($id): array
    {
        return Http::get("{$this->baseUrl}/deputados/{$id}/orgaos")->json();
    }
}
