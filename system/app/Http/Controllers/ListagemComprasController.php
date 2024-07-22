<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Modules\Listagem\Models\Lista;

class ListagemComprasController extends Controller
{
    public function index($lista_id = 0)
    {
        $listaCompras = Lista::getlistaComprasPorUser(Auth::user()->id);

        $vars = [
            'listaCompras' => $listaCompras
        ];

        return inertia::render('Master/Listagem/index', $vars);
    }

    public function getForm($id = 0)
    {
        $lista = new Lista();

        $vars = [
            'lista' => $lista,
        ];

        return Inertia::render('Master/Listagem/lista-compras', $vars);
    }

    public function cadastrar(Request $request)
    {
        $request->validate([
            'nome' => 'required',
        ]);

        $lista = new Lista();
        $lista->user_id = Auth::user()->id;
        $lista->nome = $request->nome;

        if($lista->save()) {
            return to_route('listagem.index');
        }

        return to_route('istagem.index');
    }
}
