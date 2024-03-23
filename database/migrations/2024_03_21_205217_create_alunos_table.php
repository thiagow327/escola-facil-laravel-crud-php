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
            $table->string('name')->nullable();
            $table->integer('age');
            $table->string('endereco')->nullable();
            $table->string('nomes_pais')->nullable();
            $table->string('contato_pais')->nullable();
            $table->text('informacao_medica');
            $table->string('escola')->nullable();
            $table->time('horario_entrada')->nullable();
            $table->time('horario_saida')->nullable();
            $table->decimal('mensalidade', 10, 2)->nullable();
            $table->string('status')->nullable();
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
