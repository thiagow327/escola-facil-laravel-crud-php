<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('idade');
            $table->text('observacao_de_saude')->nullable();
            $table->string('escola');
            $table->string('turno');
            $table->string('foto');
            $table->string('nome_do_primeiro_responsavel');
            $table->string('celular_do_primeiro_responsavel');
            $table->string('nome_do_segundo_responsavel')->nullable();
            $table->string('celular_do_segundo_responsavel')->nullable();
            $table->string('endereco');
            $table->decimal('valor_da_mensalidade', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
