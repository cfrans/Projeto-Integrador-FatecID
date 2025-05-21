<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Página inicial 
// TODO: Revisar se é necessário
Route::get('/', function () {
    return view('welcome');
});

// Todas as rotas abaixo exigem autenticação
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Protocolos
    Route::get('/protocolos', fn () => view('protocolos.index'))->name('protocolos.index');
    Route::get('/protocolos/{id}', fn ($id) => view('protocolos.view', ['id' => $id]))->name('protocolos.view');

    // Índices
    Route::get('/indices', fn () => view('indices.index'))->name('indices.index');

    // Autenticação de valores
    Route::get('/autenticacao', fn () => view('autenticacao.index'))->name('autenticacao.index');

    // Andamento
    Route::get('/andamento', fn () => view('andamento.index'))->name('andamento.index');
});

require __DIR__.'/auth.php';

// TODO: Criar as rotas para as paginas de admin-only (ediçao de usuarios e afins)