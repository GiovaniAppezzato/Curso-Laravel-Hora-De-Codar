@extends('layouts.main')
@section('title', 'eventos')

@section('content')

    <div class="col-12 mt-3" id="search-container">
        <h2 class="mb-3 fw-bold">Busque por um evento</h2>
        <form class="w-75 m-auto" action="/" method="GET">
            <input class="form-control" id="search" name="s" type="text" placeholder="Pressione Enter" autocomplete="none">
        </form>
    </div>

    <div class="col-12 px-5 py-4" id="events-container">
        @if($search == null)
            <h3 class="mb-2">Proximos Eventos</h3>
            <p class="mb-4" style="color: #757575;">Veja os proximos eventos</p>
        @else
            <h3 class="mb-2">Você está buscando por "{{ $search }}"</h3>
            <p class="mb-4" style="color: #757575;">Veja todos os resultados - {{ count($eventos) }}</p>
        @endif
        <div class="row" id="cards-container">
            @foreach ($eventos as $evento)
                <div class="col-12 col-md-6 col-xl-3 mb-3">
                    <div class="card">
                        <img class="rounded-top" src="/img/imagem-eventos/{{ $evento->imagem }}" alt="imagem evento - {{ $evento->titulo }}">
                        <div class="card-body">
                            <p class="card-date">{{ date('d/m/Y', strtotime($evento->data)) }}</p>
                            <h5 class="card-title">{{ $evento->titulo }}</h5>
                            <p class="card-participantes">{{ count($evento->users) }} participantes</p>
                            <a class="btn btn-primary" href="/eventos/{{ $evento->id }}">Ver mais</a>
                        </div>
                    </div>
                </div>
            @endforeach

            @if(count($eventos) == 0)
                <p class="ms-3" style="color: #757575;">Nenhum evento encontrado</p>
            @endif
        </div>
    </div>
@endsection
