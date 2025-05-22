<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Protocolo;
use App\Models\User;
use App\Models\Apresentante;
use App\Models\Grupo;
use App\Models\Especie;
use App\Models\Natureza;

class ProtocoloController extends Controller
    {

    public function create()
    {
        return view('protocolos.create', [
            'usuarios' => User::all(),
            'apresentantes' => Apresentante::all(),
            'grupos' => Grupo::all(),
            'especies' => Especie::all(),
            'naturezas' => Natureza::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_documento' => 'required|integer',
            'data_documento' => 'required|date',
            'numero_protocolo' => 'required|integer',
            'id_usuario' => 'required|exists:usuarios,id',
            'id_apresentante' => 'required|exists:apresentantes,id',
            'id_grupo' => 'required|exists:grupos,id',
            'id_especie' => 'required|exists:especies,id',
            'id_natureza' => 'required|exists:naturezas,id',
        ]);

        Protocolo::create($request->all());

        return redirect()->back()->with('success', 'Protocolo cadastrado!');
    }

}
