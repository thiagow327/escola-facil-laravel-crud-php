<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlunosController extends Controller
{
    public function index(){
        $alunos = "Lista de Alunos em AlunosController";
        return view('alunos.index', ['alunos' => $alunos]);
    }

    public function create(){
        return view('alunos.create');
    }
}
