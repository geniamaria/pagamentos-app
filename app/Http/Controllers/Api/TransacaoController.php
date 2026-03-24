<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transacao;
use Illuminate\Http\Request;

class TransacaoController extends Controller
{
    public function index(Request $request)
    {
        $query = Transacao::query();

        if ($request->has('estado') && in_array($request->estado, ['pendente', 'pago', 'falhado'])) {
            $query->where('estado', $request->estado);
        }

        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_cliente' => 'required|string|max:255',
            'telefone' => 'required|string|max:9',
            'valor' => 'required|numeric|min:0.01|max:99999999.99',
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