<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Apresentante;
class ApresentanteController extends Controller
{
    public function create()
    {
        return view('apresentante.create', data: [
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
            'tipo_contato' => 'required|string|max:100'
        ]);

        Apresentante::create($request->all());

        return redirect()->back()->with('success', 'Apresentante cadastrado!');
    }
    public function update(Request $request, $id)
    {

        \Log::info('Atualizando apresentante', [
        'id' => $id,
        'dados_recebidos' => $request->all()
         ]);

        $apresentante = Apresentante::findOrFail($id);
        $apresentante->id_documento = $request->id_documento;
        $apresentante->numero_documento = $request->numero_documento;
        $apresentante->nome = $request->nome;
        $apresentante->tipo_contato = $request->tipo_contato;
        $apresentante->numero_contato = $request->numero_contato;
        $apresentante->email = $request->email;
        $apresentante->save();

        \Log::info('Apresentante atualizado com sucesso', [
        'id' => $apresentante->id
        ]);

        return response()->json(['sucesso' => true, 'mensagem' => 'Apresentante atualizado com sucesso!']);
    }
}
