<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeputadosController;

Route::prefix('deputados')->group(function () {
    Route::get('/', [DeputadosController::class, 'index']);
    Route::get('/{id}', [DeputadosController::class, 'show']);
    Route::get('/{id}/despesas', [DeputadosController::class, 'despesas']);
    Route::get('/{id}/orgaos', [DeputadosController::class, 'orgaos']);
});
