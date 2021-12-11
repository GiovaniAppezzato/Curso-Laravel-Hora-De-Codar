@extends('layouts.main')
@section('title', 'Editar evento')

@section('content')

    <div class="row mb-5">
        <div class="col-12 col-md-6 offset-md-3">
            <h2 class="my-4 fw-bold">Editar evento</h2>

            <form action="/eventos/update/{{ $evento->id }}" method="POST" enctype="multipart/form-data"> @csrf @method('PUT')
                <div class="form-group mb-3">
                    <label for="tituloEvento" class="form-label">Evento:</label>
                    <input type="text" class="form-control" id="tituloEvento" name="titulo" placeholder="titulo" value="{{ $evento->titulo }}">
                </div>
                <div class="form-group mb-3">
                    <label for="cidadeEvento" class="form-label">Local:</label>
                    <input type="text" class="form-control" id="cidadeEvento" name="cidade" placeholder="Cidade" value="{{ $evento->cidade }}">
                </div>
                <div class="form-group mb-3">
                    <label for="descricaoEvento" class="form-label">Descrição:</label>
                    <textarea class="form-control" id="descricaoEvento" name="descricao" rows="4">{{ $evento->descricao }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="dataEvento" class="form-label">Quando vai acontecer? </label>
                    <input class="form-control" id="dataEvento" type="date" name="data" min="{{ date('Y-m-d') }}" value="{{ $evento->data->format('Y-m-d') }}">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Selecione alguns itens: </label>
                    <div class="form-check form-switch">
                        <label class="form-check-label" style="cursor: pointer" for="cadeiras">Cadeiras</label>
                        <input class="form-check-input" style="cursor: pointer" id="cadeiras" type="checkbox" value="cadeiras" name="itens[]">
                    </div>
                    <div class="form-check form-switch">
                        <label class="form-check-label" style="cursor: pointer" for="cadeiras">Palco</label>
                        <input class="form-check-input" style="cursor: pointer" id="palco" type="checkbox" value="palco" name="itens[]">
                    </div>
                    <div class="form-check form-switch">
                        <label class="form-check-label" style="cursor: pointer" for="brindes">Brindes</label>
                        <input class="form-check-input" style="cursor: pointer" id="brindes" type="checkbox" value="brindes" name="itens[]">
                    </div>
                    <div class="form-check form-switch">
                        <label class="form-check-label" style="cursor: pointer" for="bebidas">Bebidas grátis</label>
                        <input class="form-check-input" style="cursor: pointer" id="bebidas" type="checkbox" value="bebidas" name="itens[]">
                    </div>
                    <div class="form-check form-switch">
                        <label class="form-check-label" style="cursor: pointer" for="comidas">Comida a vontade</label>
                        <input class="form-check-input" style="cursor: pointer" id="comidas" type="checkbox" value="comidas" name="itens[]">
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="privateEvento" class="form-label">O evento é privado ?</label>
                    <select class="form-select" id="privateEvento" name="privado">
                        @if($evento->privado == 0)
                            <option value="0" selected>Não</option>
                            <option value="1">Sim</option>
                        @else
                            <option value="0">Não</option>
                            <option value="1" selected>Sim</option>
                        @endif
                    </select>
                </div>

                <div class="mb-3">
                    <label for="imagemEvento" class="form-label">Selecione uma imagem</label>
                    <input type="file" class="form-control" id="imagemEvento" name="imagem">

                    <div class="row">
                        <h5 class="mt-3 mb-2">Preview da imagem atual:</h5>

                        <div class="col-12 col-lg-8">
                            <label for="imagemEvento">
                                <img src="/img/imagem-eventos/{{ $evento->imagem}}" class="img-fluid rounded shadow" alt="">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <input class="btn btn-primary w-auto mt-3" type="submit" name="" value="Concluir edição">
                </div>
            </form>
        </div>
    </div>

@endsection
