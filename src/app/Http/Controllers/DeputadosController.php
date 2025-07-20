<?php

namespace App\Http\Controllers;

use App\Services\DeputadoService;

/**
 * Class DeputadosController
 * Handles requests related to deputados.
 */
class DeputadosController extends Controller
{
    protected $deputadoService;

    public function __construct(DeputadoService $deputadoService)
    {
        $this->deputadoService = $deputadoService;
    }

    public function index()
    {
        return response()->json($this->deputadoService->getDeputados());
    }

    public function show($id)
    {
        return response()->json($this->deputadoService->getDeputado($id));
    }

    public function despesas($id)
    {
        return response()->json($this->deputadoService->getDespesas($id));
    }

    public function orgaos($id)
    {
        return response()->json($this->deputadoService->getEventos($id));
    }
}
