<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Class DeputadoService
 * Handles the logic for fetching deputado data from the external API.
 */
class DeputadoService
{
    protected string $baseUrl = 'https://dadosabertos.camara.leg.br/api/v2';

    public function getDeputados()
    {
        return Http::get("{$this->baseUrl}/deputados")->json();
    }

    public function getDeputado($id)
    {
        return Http::get("{$this->baseUrl}/deputados/{$id}")->json();
    }

    public function getDespesas($id)
    {
        return Http::get("{$this->baseUrl}/deputados/{$id}/despesas")->json();
    }

    public function getEventos($id)
    {
        return Http::get("{$this->baseUrl}/deputados/{$id}/orgaos")->json();
    }
}
