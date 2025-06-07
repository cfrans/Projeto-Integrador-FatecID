<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Protocolo; // Importe o seu Model Protocolo

class DashboardController extends Controller
{
    public function index()
    {
        // Puxa os últimos 5 registros da tabela 'protocolo'
        // e 'with('apresentante')' garante que os dados do apresentante sejam carregados
        $protocolos = Protocolo::with('apresentante')
                                ->latest()
                                ->take(5)
                                ->get();

        return view('dashboard', compact('protocolos'));
    }
}