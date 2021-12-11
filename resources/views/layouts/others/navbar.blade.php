<nav class="navbar navbar-expand-lg navbar-dark bg-secondary bg-gradient shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/">HDC Eventos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link teste" aria-current="page" href="/">Home</a>
                @auth
                    <a class="nav-link" href="/eventos/criar">Criar Eventos</a>
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                    <button class="nav-link" style="border: none; background: rgba(0,0,0,0);" data-bs-toggle="modal" data-bs-target="#logout-modal">
                        Desconectar
                    </button>
                @endauth
                @guest
                    <a class="nav-link" href="/login">Entrar</a>
                    <a class="nav-link" href="/register">Registrar</a>
                @endguest
            </div>
        </div>
    </div>
</nav>

<div class="modal fade" id="logout-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title fw-bold text-white">Atenção usuário</h5>
            </div>
            <div class="modal-body">
                <p>Deseja se desconectar da sua conta?</p>
            </div>
            <div class="modal-footer">
                <form class="" action="/logout" method="POST"> @csrf
                    <button class="btn btn-danger">Sim</button>
                </form>

                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Não</button>
            </div>
        </div>
    </div>
</div>
