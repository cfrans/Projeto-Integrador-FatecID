<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Andamento;
use App\Models\Protocolo;
use App\Models\TipoParte;
use App\Models\Usuario;

class AndamentoController extends Controller
{
    public function create()
    {
        return view('andamento.create', [
            'usuario' => Usuario::all(),
            'protocolo' => Protocolo::all(),
            'tipo_parte' => TipoParte::all()
        ]);
    }

    public function store(Request $request)
    {

        Andamento::create($request->all());

        return redirect()->back()->with('success', 'Andamento cadastrado!');
    }
}
