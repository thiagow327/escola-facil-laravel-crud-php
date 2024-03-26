<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 
        'idade', 
        'observacao_de_saude', 
        'escola', 
        'turno',
        'foto',
        'nome_do_primeiro_responsavel',
        'celular_do_primeiro_responsavel',
        'nome_do_segundo_responsavel',
        'celular_do_segundo_responsavel',
        'endereco',
        'valor_da_mensalidade'
    ];
}
