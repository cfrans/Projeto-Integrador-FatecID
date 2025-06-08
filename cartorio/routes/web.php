<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProtocoloController;
use App\Http\Controllers\ApresentanteController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\AndamentoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

// Página inicial 
Route::get('/', function () {
    return redirect()->route('login');
});

// Todas as rotas abaixo exigem autenticação
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/protocolos/create', [ProtocoloController::class, 'create']);
    Route::post('/protocolos', [ProtocoloController::class, 'store'])->middleware('auth');;

    Route::get('/apresentantes/create', [ApresentanteController::class, 'create']);
    Route::post('/apresentantes', [ApresentanteController::class, 'store']);
    Route::put('/apresentantes/{id}', [ApresentanteController::class, 'update'])->name('apresentantes.update');

    Route::get('/documentos/create', [DocumentoController::class, 'create']);
    Route::post('/documentos', [DocumentoController::class, 'store']);

    // Protocolos
    Route::get('/protocolos', fn() => view('protocolos.index'))->name('protocolos.index');
    Route::get('/protocolos/view/{numero_protocolo?}', [ProtocoloController::class, 'showView'])->name('protocolos.view');

    // Índices
    Route::get('/indices', [ProtocoloController::class, 'indices'])->name('indices.index');

    // Autenticação de valores
    // Route::get('/autenticacao', fn () => view('autenticacao.index'))->name('autenticacao.index');
    Route::get('/autenticacao/{protocolo}', [AutenticacaoController::class, 'index'])->name('autenticacao.index');
    Route::post('/autenticacao', [AutenticacaoController::class, 'store'])->name('autenticacao.store');

    // Andamento
    Route::get('/andamento', [AndamentoController::class, 'index'])->name('andamento.index');
    Route::post('/andamento', [AndamentoController::class, 'store'])->name('andamento.store');

    // Sobre
    Route::get('/sobre', fn() => view('sobre.index'))->name('sobre.index');

    // Contato
    Route::get('/contato', fn() => view('contato.index'))->name('contato.index');

    Route::get('/protocolos/buscar/{numero_protocolo}', [ProtocoloController::class, 'buscarPorNumero'])->name('protocolos.buscar');
    Route::post('/protocolos/{numero_protocolo}/atualizar-data-retirada', [ProtocoloController::class, 'atualizarDataRetirada'])->name('protocolos.atualizarDataRetirada');
    Route::post('/protocolos/{numero_protocolo}/atualizar-data-cancelamento', [ProtocoloController::class, 'atualizarDataCancelamento'])->name('protocolos.atualizarDataCancelamento');
    Route::get('/protocolos/anterior/{id}', [ProtocoloController::class, 'protocoloAnterior'])->name('protocolos.anterior');
    Route::get('/protocolos/seguinte/{id}', [ProtocoloController::class, 'protocoloSeguinte'])->name('protocolos.seguinte');
    Route::get('/protocolo/buscar-indices', [ProtocoloController::class, 'buscarIndices'])->name('protocolos.buscarIndices');
    Route::get('/protocolos/ultimo', [ProtocoloController::class, 'viewUltimoProtocolo'])->name('protocolos.ultimo');

    Route::get('/andamentos', [AndamentoController::class, 'index'])->name('andamento.index');
    Route::get('/andamentos/create', [AndamentoController::class, 'create'])->name('andamento.create');
    Route::post('/andamentos', [AndamentoController::class, 'store'])->name('andamento.store');
});

require __DIR__ . '/auth.php';

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
