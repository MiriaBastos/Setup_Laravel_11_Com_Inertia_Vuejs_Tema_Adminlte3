<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DespesasController extends Controller
{
    public function form()
    {

        return inertia::render('Master.despesas.form');
    }

}
