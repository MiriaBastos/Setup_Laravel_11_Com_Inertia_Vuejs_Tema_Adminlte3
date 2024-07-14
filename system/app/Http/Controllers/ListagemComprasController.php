<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ListagemComprasController extends Controller
{
    public function index()
    {
        return inertia::render('Master/Listagem/index');
    }
}
