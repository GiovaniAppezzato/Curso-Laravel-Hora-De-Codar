<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\User;

class EventosController extends Controller
{
    /**
     * Visualizar página principal da aplicação
     * @return view
     */
    public function index()
    {
        $search = request('s');

        if($search !== null) {
            $eventos = Evento::where([['titulo', 'like', '%'.$search.'%']])->get();
        } else {
            $eventos = Evento::all();
        }

        return view('welcome', ['eventos' => $eventos, 'search' => $search]);
    }

    /**
     * Visualizar página de criação
     * @return view
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * Cria um novo evento no banco de dados
     * @param  request $request
     * @return redirect
     */
    public function store(Request $request)
    {
        // Utilizamos a classe "Request" para resgatar dados de formulários POST

        $evento = new Evento();
        $evento->titulo = $request->titulo;
        $evento->cidade = $request->cidade;
        $evento->descricao = $request->descricao;
        $evento->privado = $request->private;

        $evento->data = $request->data;
        $evento->itens = $request->itens;

        /* ===== uplaod imagem ===== */
        if($request->hasFile('imagem') && $request->imagem->isValid()):
            $arquivo = $request->imagem;
            $extensao = $arquivo->extension();
            $nomeImagemBanco = md5($arquivo->getClientOriginalName() . strtotime('now')) . "." . $extensao;

            $request->imagem->move(public_path('img/imagem-eventos'), $nomeImagemBanco);
            $evento->imagem = $nomeImagemBanco;
        endif;

        $usuario = auth()->user();
        $evento->usuario_id = $usuario->id;

        $evento->save();
        return redirect('/')->with('success', 'Evento criado com sucesso !');
    }

    /**
     * visualizar página com mais informações sobre o evento
     * @param int $id
     * @return redirect
     */
    public function show($id = null)
    {
        // findOrFail() pega todos os dados de um registro especificado do banco caso não consiga retorna um erro 404 diferente do find() que retorna null
        $evento = Evento::findOrFail($id);
        $usuario = auth()->user();

        if($usuario == null || $evento->usuario_id !== $usuario->id):
            // $criadorEvento = User::where('id', '=', $evento->usuario_id)->first()->toArray();
            $criadorEvento = User::where('id', '=', $evento->usuario_id)->first()->value('name');
        else:
            $criadorEvento = $usuario->name;
        endif;

        // Verificar se o usuário já participa do evento
        $participaEvento = false;

        if($usuario):
            $usuariosParticipantes = $evento->users->toArray();

            foreach($usuariosParticipantes as $usuarioLoop):
                $usuarioLoop['id'] == $usuario->id ? $participaEvento = true : '';
            endforeach;
        endif;

        return view('eventos.show', [
            'evento' => $evento,
            'criadorEvento' => $criadorEvento,
            'participaEvento' => $participaEvento
        ]);
    }

    /**
     * visualizar página de dashboard da aplicação
     * @return view
     */
    public function dashboard()
    {
        $usuario = auth()->user();

        /* Método da relação one to many */
        $eventosDoUsuario = $usuario->eventos;
        $eventosQueParticapa = $usuario->eventosComoParticipantes;

        return view('eventos.dashboard', ['eventos' => $eventosDoUsuario, 'eventosQueParticapa' => $eventosQueParticapa]);
    }

    /**
     * Deleta um evento do banco de dados
     * @param  int $id
     * @return redirect
     */
    public function destroy($id = null)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect('/dashboard')->with('success', 'Evento deletado com sucesso !');
    }

    /**
     * visualiza página de edição
     * @param  int $id
     */
    public function edit($id = null)
    {
        $usuarioLogado = auth()->user();
        $evento = Evento::findOrFail($id);

        return $usuarioLogado->id !== $evento->usuario_id
                    ? redirect('/')
                    : view('eventos.edit', ['evento' => $evento]) ;
    }

    /**
     * Atualizar evento
     * @param  Request $request
     * @return redirect
     */
    public function update(Request $request)
    {
        // cuidado com os "names" dos inputs, eles tem que ser iguais a coluna da tabela.
        $dados = $request->all();

        if($request->hasFile('imagem') && $request->imagem->isValid()):
            $arquivo = $request->imagem;
            $extensao = $arquivo->extension();
            $nomeImagemBanco = md5($arquivo->getClientOriginalName() . strtotime('now')) . "." . $extensao;

            $request->imagem->move(public_path('img/imagem-eventos'), $nomeImagemBanco);
            $dados['imagem'] = $nomeImagemBanco;
        endif;

        Evento::findOrFail($request->id)->update($dados);
        return redirect('/dashboard')->with('success', 'Evento editado com sucesso!');
    }

    /**
     * Confirma presença do usuário no evento
     * @param  int $id [id do Evento]
     * @return redirect
     */
    public function joinEvento($id) /* - attach "anexa" o usuario e o evento ná tabela intermediária */
    {
        $usuario = auth()->user();

        /* eventosComoParticipantes() - função da relação many to many */
        $usuario->eventosComoParticipantes()->attach($id);
        $nomeEvento = Evento::find($id)->value('titulo');

        return redirect('/dashboard')
                ->with('success', 'A sua participação no evento ' . $nomeEvento . ' está confirmada!');
    }

    /**
     * Cancelar participação do evento
     * @param  int $id [id do evento]
     * @return redirect
     */
    public function leaveEvento($id = null) /* - detach "desapega" o usuario e o evento ná tabela intermediária */
    {
        $usuario = auth()->user();
        $evento = Evento::findOrfail($id);

        $usuario->eventosComoParticipantes()->detach($id);
        // $evento->users()->detach($usuario->id);

        return redirect('/dashboard')
                ->with('success', 'A sua participação no evento ' . $evento->titulo . ' foi cancelada!');
    }
}
