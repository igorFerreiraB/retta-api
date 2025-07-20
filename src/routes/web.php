<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeputadosController;

Route::get('/', function () {
    return view('welcome');
});