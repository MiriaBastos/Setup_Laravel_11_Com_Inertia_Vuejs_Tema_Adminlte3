<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DespesasController extends Controller
{
    public function form()
    {
        return inertia::render('Master/despesas/form');
    }

    public function formCadastrar(Request $request)
    {
        $despesa = new Despesa();

        $request->validate($despesa->validationRules());

        $despesa->user_id            = Auth::id();
        $despesa->categoria_id       = 1;
        $despesa->descricao          = $request->descricao;
        $despesa->dt_dia             = $request->dt_dia;
        $despesa->dt_mes             = $request->dt_mes;
        $despesa->dt_ano             = $request->dt_ano;
        $despesa->valor_despesa      = $request->valor_despesa;
        $despesa->despesa_recorrente = $request->despesa_recorrente;

        if($despesa->salvar()) {
            return Redirect::route('despesas.form');
        } else {
            return Redirect::route('despesas.form');
        }

    }

}
