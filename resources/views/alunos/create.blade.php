@extends('layouts.app')
@section('content')
    <main class="container">
        <section>
            <form action="{{ route('alunos.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="titlebar">
                    <h1>Novo Aluno</h1>
                </div>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="bloco-aluno">
                        <p>Informações do Aluno(a)</p>
                        <hr>
                        <label>Nome Completo</label>
                        <input type="text" name="nome" value="{{ old('nome') }}">

                        <label>Idade</label>
                        <input type="text" name="idade" value="{{ old('idade') }}">

                        <label>Observação de Saúde (Opcional)</label>
                        <textarea cols="15" rows="3" name="observacao_de_saude"
                            placeholder="Ex: Sofre de asma, manter medicamento de alívio rápido disponível.">{{ old('observacao_de_saude') }}</textarea>

                        <hr>
                        <label>Escola</label>
                        <select name="escola">
                            @foreach (json_decode('{"EMEI PROF. TITO LÍVIO FERREIRA":"EMEI PROF. TITO LÍVIO FERREIRA","EMEF PROF. RAUL FERNANDES":"EMEF PROF. RAUL FERNANDES"}', true) as $optionKey => $optionValue)
                                <option value="{{ $optionKey }}" {{ old('escola') == $optionKey ? 'selected' : '' }}>
                                    {{ $optionValue }}</option>
                            @endforeach
                        </select>

                        <label>Turno</label>
                        <select name="turno">
                            @foreach (json_decode('{"MANHÃ":"MANHÃ","TARDE":"TARDE"}', true) as $optionKey => $optionValue)
                                <option value="{{ $optionKey }}" {{ old('turno') == $optionKey ? 'selected' : '' }}>
                                    {{ $optionValue }}</option>
                            @endforeach
                        </select>

                        <hr>

                        <label>Adicionar Foto</label>
                        <img src="" alt="" class="img-student" id="file-preview" />
                        <input type="hidden" name="hidden_foto_aluno" value="{{ old('hidden_foto_aluno') }}">
                        <input type="file" name="foto" accept="image/*" onchange="showFile(event)">
                    </div>

                    <div class="bloco-responsaveis">
                        <p>Informações dos Responsáveis</p>
                        <hr>
                        <label>Nome Completo do 1º Responsável</label>
                        <input type="text" name="nome_do_primeiro_responsavel"
                            value="{{ old('nome_do_primeiro_responsavel') }}">

                        <label>Celular do 1º Responsável</label>
                        <input type="text" name="celular_do_primeiro_responsavel"
                            value="{{ old('celular_do_primeiro_responsavel') }}">

                        <label>Nome Completo do 2º Responsável (Opcional)</label>
                        <input type="text" name="nome_do_segundo_responsavel"
                            value="{{ old('nome_do_segundo_responsavel') }}">

                        <label>Celular do 2º Responsável (Opcional)</label>
                        <input type="text" name="celular_do_segundo_responsavel"
                            value="{{ old('celular_do_segundo_responsavel') }}">
                        <hr>

                        <label>Endereço</label>
                        <input type="text" name="endereco" value="{{ old('endereco') }}">
                        <hr>

                        <label>Valor da Mensalidade</label>
                        <input type="text" name="valor_da_mensalidade" value="{{ old('valor_da_mensalidade') }}">
                    </div>

                </div>

                <div class="titlebar">
                    <h1></h1>
                    <input type="hidden" name="hidden_id" value="">
                    <button>Salvar</button>
                </div>
            </form>
        </section>
    </main>
    <script>
        function showFile(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('file-preview');
                output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
