<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alunos;

class AlunosController extends Controller
{
    public function index(){
        $alunos = "Lista de Alunos em AlunosController";
        return view('alunos.index', ['alunos' => $alunos]);
    }

    public function create(){
        return view('alunos.create');
    }

    public function store(Request $request){
        
        $aluno = new Alunos;

        $file_name = time() . '.' . request() -> foto->getClientOriginalExtension();
        request()->foto->move(public_path('fotos'), $file_name);

        $aluno->nome = $request->nome;
        $aluno->idade = $request->idade;
        $aluno->observacao_de_saude = $request->observacao_de_saude;
        $aluno->escola = $request->escola;
        $aluno->turno = $request->turno;
        $aluno->foto = $file_name;
        $aluno->nome_do_primeiro_responsavel = $request->nome_do_primeiro_responsavel;
        $aluno->celular_do_primeiro_responsavel = $request->celular_do_primeiro_responsavel;
        $aluno->nome_do_segundo_responsavel = $request->nome_do_segundo_responsavel;
        $aluno->celular_do_segundo_responsavel = $request->celular_do_segundo_responsavel;
        $aluno->endereco = $request->endereco;
        $aluno->valor_da_mensalidade = $request->valor_da_mensalidade;

        $aluno->save();
        return redirect()->route('alunos.index')->with('sucesso', 'Aluno adicionado com sucesso.');

    }
}
