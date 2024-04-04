<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alunos;

class AlunosController extends Controller
{
    public function index()
    {
        $alunos = Alunos::orderby('created_at')->get();
        return view('alunos.index', ['alunos' => $alunos]);
    }

    public function create()
    {
        return view('alunos.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2028'
        ]);


        $aluno = new Alunos;

        $file_name = time() . '.' . request()->foto->getClientOriginalExtension();
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
        return redirect()->route('alunos.index')->with('success', 'Aluno adicionado com sucesso.');
    }
}
