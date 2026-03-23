<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transacao;
use Illuminate\Http\Request;

class TransacaoController extends Controller
{
    public function index()
    {
        return response()->json(Transacao::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_cliente' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'valor' => 'required|numeric|min:0.01',
            'descricao' => 'nullable|string|max:255',
        ]);

        $transacao = Transacao::create($request->all());
        return response()->json($transacao, 201);
    }

    public function updateEstado(Request $request, Transacao $transacao)
    {
        $request->validate([
            'estado' => 'required|in:pendente,pago,falhado',
        ]);

        $transacao->estado = $request->estado;
        $transacao->save();

        return response()->json($transacao);
    }
}