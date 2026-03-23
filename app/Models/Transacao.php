<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_cliente',
        'telefone',
        'valor',
        'descricao',
        'estado',
    ];
}