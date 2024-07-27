<?php

namespace Modules\Listagem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Listagem\Models\Lista;

class ListagemProdutosController extends Controller
{
    public function index($lista_id = 0)
    {
        return inertia('Master/Listagem/index');
    }

}
