@extends('layouts.main')
@section('title', $evento->titulo)

@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="row mt-4">
            <div class="col-md-6" id="exibirImagemEvento">
                <img class="img-fluid shadow rounded" src="/img/imagem-eventos/{{ $evento->imagem }}" alt="imagem - {{ $evento->titulo }}">
            </div>
            <div class="col-md-6" id="informacoesContainer">
                <h2 class="fw-bold">{{ $evento->titulo }}</h2>
                <p class="ms-3 mb-4 fs-5">{{ date('d/m/Y', strtotime($evento->data))}}</p>
                <p class="event-city d-flex align-items-center">
                    <ion-icon class="me-2" style="color: #F2A340" name="location-outline"></ion-icon> {{ $evento->cidade }}
                </p>
                <p class="event-participants d-flex align-items-center">
                    <ion-icon class="me-2" style="color: #F2A340" name="people-outline"></ion-icon> {{ count($evento->users) }} Participantes
                </p>
                <p class="event-owner d-flex align-items-center">
                    <ion-icon class="me-2" style="color: #F2A340" name="star-outline"></ion-icon> {{ $criadorEvento }}
                </p>
                <h5 class="mt-4">O evento conta com:</h5>
                <ul class="items-list">
                    @foreach($evento->itens as $item)
                        <li class="d-flex align-items-center"><ion-icon class="me-2" style="color: #F2A340" name="play-outline"></ion-icon>{{ $item }}</li>
                    @endforeach
                </ul>

                {{-- Checagem participação no evento --}}
                @if(!$participaEvento)
                    <form action="/eventos/join/{{ $evento->id }}" method="post">@csrf
                        <button class="btn btn-primary mt-2" type="submit">Confimar Presença</button>
                    </form>
                @else
                    <form action="/eventos/leave/{{ $evento->id }}" method="post">@csrf @method('delete')
                        <button class="btn btn-danger mt-2" type="submit">Cancelar participação</button>
                    </form>
                @endif
            </div>
            <div class="col-12 my-3">
                <h3>Mais sobre</h3>
                <p class="event-description">{{ $evento->descricao }}</p>
            </div>
        </div>
    </div>
@endsection
