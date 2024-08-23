<?php

namespace Modules\Listagem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Listagem\Models\Lista;

class ListagemProdutosController extends Controller
{
    public function index($id)
    {
        return inertia('Master/lista-produtos/index');
    }

    public function cadastrar(Request $request)
    {
        dd($request->all());
        return inertia('Master/lista-produtos/cadastro');
    }

}
