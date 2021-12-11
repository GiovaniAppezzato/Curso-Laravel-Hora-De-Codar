@extends('layouts.main')
@section('title', 'Criar Evento')

@section('content')
    <div class="row mb-5">
        <div class="col-12 col-md-6 offset-md-3">
            <h2 class="my-4 fw-bold">Crie um evento</h2>

            <form action="/eventos" method="POST" enctype="multipart/form-data"> @csrf
                <div class="form-group mb-3">
                    <label for="tituloEvento" class="form-label">Evento:</label>
                    <input type="text" class="form-control" id="tituloEvento" name="titulo" placeholder="titulo">
                </div>
                <div class="form-group mb-3">
                    <label for="cidadeEvento" class="form-label">Local:</label>
                    <input type="text" class="form-control" id="cidadeEvento" name="cidade" placeholder="Cidade">
                </div>
                <div class="form-group mb-3">
                    <label for="descricaoEvento" class="form-label">Descrição:</label>
                    <textarea class="form-control" id="descricaoEvento" name="descricao" rows="4"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="dataEvento" class="form-label">Quando vai acontecer? </label>
                    <input class="form-control" id="dataEvento" type="date" name="data" min="{{ date('Y-m-d') }}">
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
                    <select class="form-select" id="privateEvento" name="private">
                        <option value="0" selected>Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="imagemEvento" class="form-label">Selecione uma imagem</label>
                    <input type="file" class="form-control" id="imagemEvento" name="imagem">
                </div>

                <div class="row justify-content-center">
                    <input class="btn btn-primary w-auto mt-3" type="submit" name="" value="Enviar evento">
                </div>
            </form>
        </div>
    </div>
@endsection
