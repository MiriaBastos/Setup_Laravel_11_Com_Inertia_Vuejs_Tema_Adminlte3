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
    Route::put('/listagem-atualizar', [ListagemController::class, 'update'])->name('listagem.update');
    Route::delete('/listagem-excluir/{id}', [ListagemController::class, 'excluir'])->name('listagem.excluir');
    /* LISTA DE PRODUTOS */
    Route::get('/lista-produto/{id}', [ListagemProdutosController::class, 'index'])->name('lista-produto.index');
    Route::post('/lista-produto/cadastrar', [ListagemProdutosController::class, 'cadastrar'])->name('lista-produto.cadastrar');
    Route::put('/lista-produto/editar', [ListagemProdutosController::class, 'update'])->name('lista-produto.update');
});
