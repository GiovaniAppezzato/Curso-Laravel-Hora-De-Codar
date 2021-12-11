@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <div class="col-md-10 offset-md-1 my-4 dashboard-title">
        <h2 class="fw-bold">Meus Eventos</h2>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-eventos">
        @if(count($eventos) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th class="" scope="col">#</th>
                        <th class="" scope="col">Nome</th>
                        <th class="" scope="col">Participantes</th>
                        <th class="" scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventos as $evento)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td scope="row"><a href="/eventos/{{ $evento->id }}">{{ $evento->titulo }}</a></td>
                            <td scope="row">{{ count($evento->users) }}</td>
                            <td scope="row">
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal-editar{{ $loop->index + 1 }}">Editar</button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete{{ $loop->index + 1 }}">Deletar</button>
                            </td>
                        </tr>

                        {{-- ===== Modal edit ===== --}}
                        <div class="modal fade" id="modal-editar{{ $loop->index + 1 }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-success bg-gradient">
                                        <h5 class="modal-title fw-bold text-white">Editar evento - {{ $loop->index + 1 }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </symbol>
                                            </svg>

                                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                <div>Altere <span class="fw-bold">apenas</span> os dados que deseja mudar</div>
                                            </div>
                                        </div>

                                        <form action="/eventos/update/{{ $evento->id }}" method="POST" enctype="multipart/form-data"> @csrf @method('PUT')
                                            <div class="form-group mb-2">
                                                <label for="tituloEvento" class="form-label">Evento:</label>
                                                <input type="text" class="form-control" id="tituloEvento" name="titulo" placeholder="titulo" value="{{ $evento->titulo }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="cidadeEvento" class="form-label">Local:</label>
                                                <input type="text" class="form-control" id="cidadeEvento" name="cidade" placeholder="Cidade" value="{{ $evento->cidade }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="descricaoEvento" class="form-label">Descrição:</label>
                                                <textarea class="form-control" id="descricaoEvento" name="descricao" rows="4">{{ $evento->descricao }}</textarea>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="dataEvento" class="form-label">Quando vai acontecer? </label>
                                                <input class="form-control" id="dataEvento" type="date" name="data" min="{{ date('Y-m-d') }}" value="{{ $evento->data->format('Y-m-d') }}">
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Selecione alguns itens: </label>
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label" style="cursor: pointer" for="cadeiras">Cadeiras</label>
                                                    <input class="form-check-input" style="cursor: pointer" id="cadeiras" type="checkbox" value="cadeiras" name="itens[]" {{ in_array('cadeiras', $evento->itens) ? 'checked' : ''; }}>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label" style="cursor: pointer" for="cadeiras">Palco</label>
                                                    <input class="form-check-input" style="cursor: pointer" id="palco" type="checkbox" value="palco" name="itens[]" {{ in_array('palco', $evento->itens) ? 'checked' : ''; }}>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label" style="cursor: pointer" for="brindes">Brindes</label>
                                                    <input class="form-check-input" style="cursor: pointer" id="brindes" type="checkbox" value="brindes" name="itens[]" {{ in_array('brindes', $evento->itens) ? 'checked' : ''; }}>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label" style="cursor: pointer" for="bebidas">Bebidas grátis</label>
                                                    <input class="form-check-input" style="cursor: pointer" id="bebidas" type="checkbox" value="bebidas" name="itens[]" {{ in_array('bebidas', $evento->itens) ? 'checked' : ''; }}>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label" style="cursor: pointer" for="comidas">Comida a vontade</label>
                                                    <input class="form-check-input" style="cursor: pointer" id="comidas" type="checkbox" value="comidas" name="itens[]" {{ in_array('comidas', $evento->itens) ? 'checked' : ''; }}>
                                                </div>
                                            </div>

                                            <div class="form-group mb-2">
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
                                                    <div class="col-12 col-lg-6">
                                                        <label for="imagemEvento">
                                                            <img src="/img/imagem-eventos/{{ $evento->imagem}}" class="img-fluid rounded shadow" alt="">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Concluir edição</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===== modal delete ===== --}}
                        <div class="modal fade" id="modal-delete{{ $loop->index + 1 }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title fw-bold text-white">Atenção usuário!</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-2">Deseja deletar o evento {{ $loop->index + 1 }} - <span class="fw-bold">{{ $evento->titulo }}</span>?</p>

                                        <div class="accordion" id="accordion{{ $loop->index + 1 }}">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $loop->index + 1 }}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index + 1 }}" aria-expanded="false" aria-controls="collapse{{ $loop->index + 1 }}">
                                                        Mais informações
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $loop->index + 1 }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordion{{ $loop->index + 1 }}">
                                                    <div class="accordion-body">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item"><span class="fw-bold">Número: </span> {{ $loop->index + 1 }}</li>
                                                            <li class="list-group-item"><span class="fw-bold">Evento: </span> {{ $evento->titulo }}</li>
                                                            <li class="list-group-item"><span class="fw-bold">Local: </span> {{ $evento->cidade }}</li>
                                                            <li class="list-group-item"><span class="fw-bold">Descrição: </span> {{ $evento->descricao }}</li>
                                                            <li class="list-group-item"><span class="fw-bold">Data: </span> {{ date('d/m/Y', strtotime($evento->data)) }}</li>
                                                            <li class="list-group-item"><span class="fw-bold">Evento privado: </span> {{ $evento->privado == 0 ? 'Não' : 'Sim' }}</li>
                                                            <li class="list-group-item"><span class="fw-bold">Participantes: </span>{{ count($evento->users) }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form class="d-inline-block" action="/eventos/{{ $evento->id }}" method="POST"> @csrf @method('delete')
                                            <button class="btn btn-danger">Deletar</button>
                                        </form>

                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não tem eventos, <a href="/eventos/criar">criar evento</a></p>
        @endif
    </div>

    {{-- Eventos que estou participando --}}
    <div class="col-md-10 offset-md-1 mt-5">
        <h3 class="fw-bold">Eventos que estou participando</h3>

        @if(count($eventosQueParticapa) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th class="" scope="col">#</th>
                        <th class="" scope="col">Nome</th>
                        <th class="" scope="col">Participantes</th>
                        <th class="" scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventosQueParticapa as $evento)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td scope="row"><a href="/eventos/{{ $evento->id }}">{{ $evento->titulo }}</a></td>
                            <td scope="row">{{ count($evento->users) }}</td>
                            <td scope="row">
                                <form action="/eventos/leave/{{ $evento->id }}" method="POST"> @csrf @method('delete')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Cancelar participação</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não participa de <span class="fw-bold">nenhum</span> evento, <a href="/">veja outros eventos</a> </p>
        @endif
    </div>
@endsection
