<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunosController;
use App\Models\Alunos;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('alunos', AlunosController::class);
