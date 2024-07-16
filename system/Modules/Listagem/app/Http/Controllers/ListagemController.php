<?php

namespace Modules\Listagem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ListagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('listagem::index');
    }

}
