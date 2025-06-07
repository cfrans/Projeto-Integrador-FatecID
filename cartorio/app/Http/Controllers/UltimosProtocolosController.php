<?php

namespace App\Http\Controllers;

use App\Models\Protocolo;
use Illuminate\Http\Request;

class UltimosProtocolosController extends Controller
{
    public function index()
    {
        // Puxa os últimos 5 registros da tabela 'protocolo'
        // e 'with('apresentante')' garante que os dados do apresentante sejam carregados
        $protocolos = Protocolo::with('apresentante') // Carrega o relacionamento 'apresentante'
                                ->latest()
                                ->take(5)
                                ->get();

        return view('ultimos-protocolos', compact('protocolos'));
    }
}