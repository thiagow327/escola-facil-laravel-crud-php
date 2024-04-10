<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alunos;

class AlunosController extends Controller
{
    private function validateRequest(Request $request)
    {
        return $request->validate([
            'nome' => 'required',
            'idade' => 'required|integer|min:0',
            'observacao_de_saude' => 'nullable|string',
            'escola' => 'nullable|string',
            'turno' => 'nullable|string',
            'nome_do_primeiro_responsavel' => 'required|string',
            'celular_do_primeiro_responsavel' => 'required|numeric',
            'nome_do_segundo_responsavel' => 'nullable|string',
            'celular_do_segundo_responsavel' => 'nullable|numeric',
            'endereco' => 'required|string',
            'valor_da_mensalidade' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2028',
        ], [
            'nome.required' => 'O campo "Nome Completo" é obrigatório.',
            'idade.required' => 'O campo "Idade" é obrigatório.',
            'idade.integer' => 'O campo "Idade" deve ser um número inteiro.',
            'idade.min' => 'O campo "Idade" deve ser no mínimo :min.',
            'observacao_de_saude.string' => 'O campo "Observação de Saúde" deve ser uma string.',
            'escola.string' => 'O campo "Escola" deve ser uma string.',
            'turno.string' => 'O campo "Turno" deve ser uma string.',
            'nome_do_primeiro_responsavel.required' => 'O campo "Nome do Primeiro Responsável" é obrigatório.',
            'nome_do_primeiro_responsavel.string' => 'O campo "Nome do Primeiro Responsável" deve ser uma string.',
            'celular_do_primeiro_responsavel.required' => 'O campo "Celular do Primeiro Responsável" é obrigatório.',
            'celular_do_primeiro_responsavel.numeric' => 'O campo "Celular do Primeiro Responsável" deve ser um número.',
            'nome_do_segundo_responsavel.string' => 'O campo "Nome do Segundo Responsável" deve ser uma string.',
            'celular_do_segundo_responsavel.numeric' => 'O campo "Celular do Segundo Responsável" deve ser um número.',
            'endereco.required' => 'O campo "Endereço" é obrigatório.',
            'endereco.string' => 'O campo "Endereço" deve ser uma string.',
            'valor_da_mensalidade.required' => 'O campo "Valor da Mensalidade" é obrigatório.',
            'valor_da_mensalidade.numeric' => 'O campo "Valor da Mensalidade" deve ser um número.',
            'valor_da_mensalidade.min' => 'O campo "Valor da Mensalidade" deve ser no mínimo :min.',
            'foto.image' => 'O arquivo enviado para a foto não é uma imagem válida.',
            'foto.mimes' => 'A foto deve ser do tipo: jpg, png, jpeg, gif ou svg.',
            'foto.max' => 'A foto não deve exceder :max kilobytes.',
        ]);
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $alunos = Alunos::where('nome', 'LIKE', "%$keyword%")
                ->orWhere('escola', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $alunos = Alunos::latest()->paginate($perPage);
        }
        return view('alunos.index', ['alunos' => $alunos]);
    }

    public function create()
    {
        return view('alunos.create');
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $aluno = new Alunos;

        // Verificar se uma imagem foi enviada
        if ($request->hasFile('foto')) {
            $file_name = time() . '.' . request()->foto->getClientOriginalExtension();
            request()->foto->move(public_path('fotos'), $file_name);
            $aluno->foto = $file_name;
        }

        $aluno->nome = $request->nome;
        $aluno->idade = $request->idade;
        $aluno->observacao_de_saude = $request->observacao_de_saude;
        $aluno->escola = $request->escola;
        $aluno->turno = $request->turno;
        $aluno->nome_do_primeiro_responsavel = $request->nome_do_primeiro_responsavel;
        $aluno->celular_do_primeiro_responsavel = $request->celular_do_primeiro_responsavel;
        $aluno->nome_do_segundo_responsavel = $request->nome_do_segundo_responsavel;
        $aluno->celular_do_segundo_responsavel = $request->celular_do_segundo_responsavel;
        $aluno->endereco = $request->endereco;
        $aluno->valor_da_mensalidade = $request->valor_da_mensalidade;

        $aluno->save();
        return redirect()->route('alunos.index')->with('success', 'Aluno adicionado com sucesso.');
    }

    public function edit($id)
    {
        $aluno = Alunos::findOrFail($id);
        return view('alunos.edit', ['aluno' => $aluno]);
    }

    public function update(Request $request, Alunos $aluno)
    {
        $this->validateRequest($request);

        $aluno = Alunos::find($request->hidden_id);

        $aluno->nome = $request->nome;
        $aluno->idade = $request->idade;
        $aluno->observacao_de_saude = $request->observacao_de_saude;
        $aluno->escola = $request->escola;
        $aluno->turno = $request->turno;

        if ($request->hasFile('foto')) {
            $file_name = time() . '.' . $request->foto->getClientOriginalExtension();
            $request->foto->move(public_path('fotos'), $file_name);
            // Excluir a imagem antiga apenas se uma nova imagem for fornecida
            $image_path = public_path('fotos/') . $aluno->foto;
            if (file_exists($image_path)) {
                @unlink($image_path);
            }
            $aluno->foto = $file_name;
        }

        $aluno->nome_do_primeiro_responsavel = $request->nome_do_primeiro_responsavel;
        $aluno->celular_do_primeiro_responsavel = $request->celular_do_primeiro_responsavel;
        $aluno->nome_do_segundo_responsavel = $request->nome_do_segundo_responsavel;
        $aluno->celular_do_segundo_responsavel = $request->celular_do_segundo_responsavel;
        $aluno->endereco = $request->endereco;
        $aluno->valor_da_mensalidade = $request->valor_da_mensalidade;

        $aluno->save();

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado');
    }

    public function destroy($id)
    {
        $aluno = Alunos::findOrFail($id);
        $image_path = public_path() . "/fotos/";
        $image = $image_path . $aluno->foto;
        if (file_exists($image)) {
            @unlink($image);
        }
        $aluno->delete();
        return redirect('alunos')->with('success', 'Aluno deletado!');
    }
}
