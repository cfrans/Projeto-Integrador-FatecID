<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Apresentante;
class ApresentanteController extends Controller
{
    public function create()
    {
        return view('apresentantes.create', data: [
            'documentos' => Documento::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_documento' => 'required|exists:documentos,id',
            'numero_documento' => 'required|string|max:20',
            'nome' => 'required|string|max:64',
            'numero_contato' => 'required|string|max:15',
            'email' => 'required|email|max:100',
        ]);

        Apresentante::create($request->all());

        return redirect()->back()->with('success', 'Apresentante cadastrado!');
    }
}
