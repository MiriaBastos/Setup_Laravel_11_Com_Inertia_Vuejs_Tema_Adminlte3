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
        $lista = new Lista();
        if($lista_id > 0) {
            $lista = Lista::find($lista_id);
        }

        $listaCompras = Lista::getlistaComprasPorUser(Auth::user()->id);

        $vars = [
            'lista' => $lista,
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

    public function postForm(Request $request)
    {

        dd($request->all());
        // $request->validate([
        //     'nome' => 'required',
        // ]);

        // $lista = new Lista();
        // $lista->nome = $request->nome;
        // $lista->save();

        return 'salvou';
        // return Redirect::route('listagem-compras.index');
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
            return Redirect::route('listagem.index', ['lista_id' => $lista->id]);
        }

        return Redirect::route('listagem.index');
    }
}
