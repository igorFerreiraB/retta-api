<?php

namespace App\Http\Controllers;

use App\Services\DeputadoService;

class DeputadosController extends Controller
{
    protected $deputadoService;

    public function __construct(DeputadoService $deputadoService)
    {
        $this->deputadoService = $deputadoService;
    }

    /**
     * Retorna uma lista com todos os deputados.
     * 
     * Rota: GET /deputados
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->deputadoService->getDeputados());
    }

    /**
     * Retorna os dados detalhados de um deputado específico pelo seu ID.
     * 
     * Rota: GET /deputados/{id}
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json($this->deputadoService->getDeputado($id));
    }

    /**
     * Retorna a lista de despesas do deputado informado pelo ID.
     * 
     * Rota: GET /deputados/{id}/despesas
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function despesas($id)
    {
        return response()->json($this->deputadoService->getDespesas($id));
    }

    /**
     * Retorna os órgãos e comissões que o deputado participa.
     * 
     * Rota: GET /deputados/{id}/orgaos
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function orgaos($id)
    {
        return response()->json($this->deputadoService->getEventos($id));
    }
}
