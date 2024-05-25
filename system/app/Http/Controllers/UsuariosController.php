<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class UsuariosController extends Controller
{
    public function form()
    {
        return inertia::render('Master/usuarios/form');
    }

}
