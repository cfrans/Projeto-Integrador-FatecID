<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;

class DocumentoController extends Controller
{
    public function create()
    {
        return view('documentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:64',
            'classificacao' => 'required|string|max:30',
        ]);

        Documento::create($request->all());

        return redirect()->back()->with('success', 'Documento cadastrado!');
    }
}