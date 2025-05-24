<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Protocolo;
use App\Models\Usuario;
use App\Models\Apresentante;
use App\Models\Grupo;
use App\Models\Especie;
use App\Models\Natureza;

class ProtocoloController extends Controller
    {

    public function create()
    {
        return view('protocolo.create', [
            'usuario' => Usuario::all(),
            'apresentantes' => Apresentante::all(),
            'grupos' => Grupo::all(),
            'especies' => Especie::all(),
            'naturezas' => Natureza::all(),
        ]);
    }

    public function store(Request $request)
    {

        // dd($request->all());

        try {
        //     $request->validate([
        //     'numero_documento' => 'required|integer',
        //     'data_documento' => 'required|date',
        //     'numero_protocolo' => 'required|integer',
        //     'numero_registro' => 'required|integer',
        //     'data_retirada' => 'required|date',
        //     'data_cancelamento' => 'nullable|date',
        //     'id_usuario' => 'required|exists:usuario,id',
        //     'id_apresentante' => 'required|exists:apresentante,id',
        //     'id_grupo' => 'required|exists:grupo,id',
        //     'id_especie' => 'required|exists:especie,id',
        //     'id_natureza' => 'required|exists:natureza,id',
            
        // ]);

        $validated = $request->validate([
            'id_documento' => 'required|integer',
            'numero_documento' => 'required|integer',
            'nome' => 'required|string|max:255',
            'numero_contato' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'tipo_contato' => 'required|string|max:50',
        ]);

        // Criar o apresentante primeiro
        $apresentante = Apresentante::create([
            'id_documento' => $validated['id_documento'],
            'numero_documento' => $validated['numero_documento'],
            'nome' => $validated['nome'],
            'numero_contato' => $validated['numero_contato'],
            'email' => $validated['email'],
            'tipo_contato' => $validated['tipo_contato']
        ]);

        dd($apresentante);

       return redirect()->back()->with('success', 'Protocolo cadastrado!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao cadastrar: ' . $e->getMessage());
        }

        
        // Após criar o protocolo
        

        // // Criar o protocolo relacionando ao apresentante
        // $protocolo = Protocolo::create([
        //     'numero_documento' => $validated['numero_documento'],
        //     'id_grupo' => $validated['id_grupo'],
        //     'id_apresentante' => $apresentante->id,
        //     // ... outros campos do protocolo
        // ]);


        // Protocolo::create($request->all());

        // return redirect()->back()->with('success', 'Protocolo cadastrado!');
    }

}
