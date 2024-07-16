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
    public function index()
    {
        return inertia::render('Master/Listagem/index');
    }

    public function getForm($id = 0)
    {
        $lista = new Lista();

        $vars = [
            'lista' => $lista,
        ];

        return Inertia::render('Master/Listagem/lista-compras', $vars);
    }
}
