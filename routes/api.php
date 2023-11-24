<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/clientes', ClienteController::class);
Route::resource('/pets', PetController::class);

Route::get('/cliente/search', [ClienteController::class, 'searchCliente']);
Route::get('/pet/search', [PetController::class, 'search']);
