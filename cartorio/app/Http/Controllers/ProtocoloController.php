<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Protocolo;
use App\Models\Usuario;
use App\Models\Apresentante;
use App\Models\Grupo;
use App\Models\Especie;
use App\Models\Natureza;
use App\Models\Parte;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ProtocoloController extends Controller
{


    public function create()
    {
        return view('protocolo.create', [
            'usuario' => Usuario::all(),
            'apresentante' => Apresentante::all(),
            'grupos' => Grupo::all(),
            'especies' => Especie::all(),
            'naturezas' => Natureza::all(),
        ]);
    }

    public function store(Request $request)
    {

        // dd($request->all());

        try {

            $validated = $request->validate([
                'id_documento' => 'required|integer',
                'numero_documento' => 'required|integer',
                'nome' => 'required|string|max:255',
                'numero_contato' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'tipo_contato' => 'required|string|max:50',
                'data_documento' => 'required|date',
                'numero_protocolo' => 'required|integer',
                'numero_registro' => 'required|integer',
                'data_retirada' => 'required|date',
                'data_registro' => 'required|date',
                'data_cancelamento' => 'nullable|date',
                'id_grupo' => 'required|exists:grupo,id',
                'id_especie' => 'required|exists:especie,id',
                'id_natureza' => 'required|exists:natureza,id',
            ]);


            $apresentante = Apresentante::create($validated);
            Log::info('Apresentante criado: ', $apresentante->toArray());

            // Criar o protocolo relacionando ao apresentante
            $protocolo = Protocolo::create([
                'numero_documento' => $validated['numero_documento'],
                'id_grupo' => $validated['id_grupo'],
                'id_apresentante' => $apresentante->id,
                'data_documento' => $validated['data_documento'],
                'data_abertura' => Carbon::now()->format('Y-m-d'),
                'data_cancelamento' => $validated['data_cancelamento'],
                'numero_protocolo' => $validated['numero_protocolo'],
                'numero_registro' => $validated['numero_registro'],
                'data_registro' => $validated['data_registro'],
                'data_retirada' => $validated['data_retirada'],
                'id_usuario' => auth()->user()->id,
                'id_especie' => $validated['id_especie'],
                'id_natureza' => $validated['id_natureza'],
            ]);

            Log::info('Protocolo criado: ', $protocolo->toArray());

            $tipos = $request->input('id_tipo_parte');
            $nomes = $request->input('identificacao');

            foreach ($tipos as $index => $tipo) {
                Parte::create([
                    'id_tipo_parte' => $tipo,
                    'identificacao' => $nomes[$index],
                    'id_protocolo' => $protocolo->id
                ]);
            }

            return redirect()->back()->with('success', 'Protocolo cadastrado!');
        } catch (\Exception $e) {
            Log::error('Erro ao criar apresentante: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao cadastrar: ' . $e->getMessage());
        }
    }
}
