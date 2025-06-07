<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProtocoloController;
use App\Http\Controllers\ApresentanteController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\AndamentoController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

// Página inicial 
Route::get('/', function () {
    return redirect()->route('login');
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
    // Route::get('/autenticacao', fn () => view('autenticacao.index'))->name('autenticacao.index');
    Route::get('/autenticacao/{protocolo}', [AutenticacaoController::class, 'index'])->name('autenticacao.index');
    Route::post('/autenticacao', [AutenticacaoController::class, 'store'])->name('autenticacao.store');

    // Andamento
    Route::get('/andamento', [AndamentoController::class, 'index'])->name('andamento.index');
    Route::post('/andamento', [AndamentoController::class, 'store'])->name('andamento.store');

    // Sobre
    Route::get('/sobre', fn () => view('sobre.index'))->name('sobre.index');

    // Contato
    Route::get('/contato', fn () => view('contato.index'))->name('contato.index');

    Route::get('/protocolos/buscar/{numero}', [ProtocoloController::class, 'buscarPorNumero'])->name('protocolos.buscar');
    Route::post('/protocolos/{numero_protocolo}/atualizar-data-retirada', [ProtocoloController::class, 'atualizarDataRetirada'])->name('protocolos.atualizarDataRetirada');

    Route::get('/protocolo/buscar-indices', [ProtocoloController::class, 'buscarParaIndices']);
    Route::get('/protocolos/ultimo', [ProtocoloController::class, 'viewUltimoProtocolo'])->name('protocolos.ultimo');

});

require __DIR__.'/auth.php';

// TODO: Criar as rotas para as paginas de admin-only (ediçao de usuarios e afins)

// teste de conexao do banco, depois remover
use Illuminate\Support\Facades\DB;
Route::get('/testar-conexao-db', function () {
    try {
        DB::connection()->getPdo(); // Tenta obter a conexão PDO
        return 'Conexão com o banco de dados OK!';
    } catch (\Exception $e) {
        return 'Erro na conexão com o banco de dados: ' . $e->getMessage();
    }
});

Route::post('/log-js-error', function (\Illuminate\Http\Request $request) {
    Log::error('[JS ERROR] ' . json_encode($request->all()));
    return response()->json(['ok' => true]);
});