<?php

use Illuminate\Support\Facades\Route;
use Modules\Listagem\Http\Controllers\ListagemController;
use Modules\Listagem\Http\Controllers\ListagemProdutosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    // Route::resource('listagem', ListagemController::class)->names('listagem');
});

Route::middleware('auth')->group(function () {
    Route::get('/listagem', [ListagemController::class, 'index'])->name('listagem.index');
    Route::post('/listagem', [ListagemController::class, 'cadastrar'])->name('listagem.cadastrar');
    Route::get('/listagem-deletar/{lista_id}', [ListagemController::class, 'deletar'])->name('listagem.deletar');
    /* LISTA DE PRODUTOS */
    Route::get('/lista-produto', [ListagemProdutosController::class, 'index'])->name('lista-produto.index');
});
