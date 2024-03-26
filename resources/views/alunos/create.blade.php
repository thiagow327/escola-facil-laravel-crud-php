@extends('layouts.app')
@section('content')
<main class="container">
    <section>
        <form action="{{route('alunos.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="titlebar">
                <h1>Novo Aluno</h1>
            </div>
            <div class="card">
                <div class="bloco-aluno">
                    <p>Informações do Aluno(a)</p>
                    <hr>
                    <label>Nome Completo <span style="color: red;">*</span></label>
                    <input type="text" name="nome" required>

                    <label>Idade <span style="color: red;">*</span></label>
                    <input type="text" name="idade" required>

                    <label>Observação de Saúde (Opcional)</label>
                    <textarea cols="15" rows="3" name="observacao_de_saude" placeholder="Ex: Sofre de asma, manter medicamento de alívio rápido disponível."></textarea>

                    <hr>
                    <label>Escola</label>
                    <select name="escola" required>
                        @foreach (json_decode('{"EMEI PROF. TITO LÍVIO FERREIRA":"EMEI PROF. TITO LÍVIO FERREIRA","EMEF PROF. RAUL FERNANDES":"EMEF PROF. RAUL FERNANDES"}',true) as $optionKey => $optionValue )
                        <option value="{{$optionKey}}">{{ $optionValue }}</option>
                        @endforeach
                    </select>

                    <label>Turno</label>
                    <select name="turno" required>
                        @foreach (json_decode('{"MANHÃ":"MANHÃ","TARDE":"TARDE"}',true) as $optionKey => $optionValue )
                        <option value="{{$optionKey}}">{{ $optionValue }}</option>
                        @endforeach
                    </select>

                    <hr>

                    <label>Adicionar Foto</label>
                    <img src="" alt="" class="img-student" id="file-preview" />
                    <input type="file" name="foto" accept="image/*" onchange="showFile(event)">
                </div>

                <div class="bloco-responsaveis">
                    <p>Informações dos Responsáveis</p>
                    <hr>
                    <label>Nome Completo do 1ºResponsável <span style="color: red;">*</span></label>
                    <input type="text" name="nome_do_primeiro_responsavel" required>

                    <label>Celular do 1ºResponsável <span style="color: red;">*</span></label>
                    <input type="text" name="celular_do_primeiro_responsavel" required>

                    <label>Nome Completo do 2ºResponsável (Opcional)</label>
                    <input type="text" name="nome_do_segundo_responsavel">

                    <label>Celular do 2ºResponsável (Opcional)</label>
                    <input type="text" name="celular_do_segundo_responsavel">
                    <hr>

                    <label>Endereço <span style="color: red;">*</span></label>
                    <input type="text" name="endereco" required>
                    <hr>

                    <label>Valor da Mensalidade <span style="color: red;">*</span></label>
                    <input type="text" name="valor_da_mensalidade" required>
                </div>

            </div>

            <div class="titlebar">
                <h1></h1>
                <button>Save</button>
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