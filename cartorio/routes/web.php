<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProtocoloController;
use App\Http\Controllers\ApresentanteController;
use App\Http\Controllers\DocumentoController;
use Illuminate\Support\Carbon;

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

    Route::get('/protocolos/create', [ProtocoloController::class, 'create']);
    Route::post('/protocolos', [ProtocoloController::class, 'store'])->middleware('auth');;

    Route::get('/apresentantes/create', [ApresentanteController::class, 'create']);
    Route::post('/apresentantes', [ApresentanteController::class, 'store']);

    Route::get('/documentos/create', [DocumentoController::class, 'create']);
    Route::post('/documentos', [DocumentoController::class, 'store']);

    // Protocolos
    Route::get('/protocolos', fn () => view('protocolos.index'))->name('protocolos.index');
    Route::get('/protocolos/view', fn () => view('protocolos.view'))->name('protocolos.view');

    // Índices
    Route::get('/indices', fn () => view('indices.index'))->name('indices.index');

    // Autenticação de valores
    Route::get('/autenticacao', fn () => view('autenticacao.index'))->name('autenticacao.index');

    // Andamento
    Route::get('/andamento', fn () => view('andamento.index'))->name('andamento.index');

    // Sobre
    Route::get('/sobre', fn () => view('sobre.index'))->name('sobre.index');

    // Contato
    Route::get('/contato', fn () => view('contato.index'))->name('contato.index');
});

require __DIR__.'/auth.php';

// TODO: Criar as rotas para as paginas de admin-only (ediçao de usuarios e afins)