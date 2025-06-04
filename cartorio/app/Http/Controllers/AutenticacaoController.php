<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Protocolo;

class AutenticacaoController extends Controller
{
    public function index($protocolo)
    {
        $protocolo = \App\Models\Protocolo::with(['grupo', 'apresentante'])->where('numero_protocolo', $protocolo)->firstOrFail();
        return view('autenticacao.index', compact('protocolo'));
    }
}
