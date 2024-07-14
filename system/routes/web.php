<?php

use App\Http\Controllers\DespesasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListagemComprasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/despesas', [DespesasController::class, 'form'])->name('despesas.form');
    Route::get('/listagem', [ListagemComprasController::class, 'index'])->name('listagem.index');
    Route::post('/despesas', [DespesasController::class, 'formCadastrar'])->name('despesas.cadastrar');
    Route::get('/usuario', [UsuariosController::class, 'form'])->name('usuarios.form');
});

// Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function () {
//     AdvancedRoute::controllers([
//         'listagem' => '\Modules\Listagem\Http\Controllers\ListagemController',
//     ]);
// });

require __DIR__.'/auth.php';
