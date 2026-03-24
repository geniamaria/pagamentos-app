<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransacaoController;

Route::get('/transacoes', [TransacaoController::class, 'index']);
Route::post('/transacoes', [TransacaoController::class, 'store']);
Route::patch('/transacoes/{transacao}/estado', [TransacaoController::class, 'updateEstado']);
