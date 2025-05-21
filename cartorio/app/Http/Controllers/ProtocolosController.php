<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Protocolo; // ajuste conforme o nome/modelo

class ProtocolosController extends Controller
{
    public function index()
    {
        $protocolos = Protocolo::all();
        return view('indices.index', compact('protocolos'));
    }

    public function show($id)
    {
        $protocolo = Protocolo::findOrFail($id);
        return view('indices.show', compact('protocolo'));
    }

    public function pesquisar(Request $request)
    {
        $query = Protocolo::query();

        if ($request->filled('grupo')) {
            $query->where('grupo', $request->grupo);
        }

        if ($request->filled('natureza')) {
            $query->where('natureza', $request->natureza);
        }

        // Continue com outros filtros conforme o formulário...

        $protocolos = $query->get();

        return view('indices.index', compact('protocolos'));
    }
}
