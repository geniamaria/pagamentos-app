<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransacaosTable extends Migration
{
   
    public function up(): void
    {
        Schema::create('transacaos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente');
            $table->string('telefone');
            $table->decimal('valor', 10, 2);
            $table->string('descricao')->nullable();
            $table->enum('estado', ['pendente', 'pago', 'falhado'])->default('pendente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacaos');
    }
}