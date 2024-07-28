<?php

namespace Modules\Listagem\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Listagem\Models\Lista;

class ListagemProdutosController extends Controller
{
    public function index($id)
    {
        return inertia('Master/lista-produtos/index');
    }

}
