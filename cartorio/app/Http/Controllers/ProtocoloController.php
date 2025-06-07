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
                'numero_documento_protocolo' => 'required|integer',
                'numero_documento_apresentante' => 'required|integer',
                'id_documento' => 'required|integer',
                'nome' => 'required|string|max:255',
                'numero_contato' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'tipo_contato' => 'required|string|max:50',
                'data_documento' => 'required|date',
                'id_grupo' => 'required|exists:grupo,id',
                'id_especie' => 'required|exists:especie,id',
                'id_natureza' => 'required|exists:natureza,id',
            ]);

            $apresentante = Apresentante::create([
                'id_documento' => $validated['id_documento'],
                'numero_documento' => $validated['numero_documento_apresentante'],
                'nome' => $validated['nome'],
                'numero_contato' => $validated['numero_contato'],
                'email' => $validated['email'],
                'tipo_contato' => $validated['tipo_contato'],
            ]);
            Log::info('Apresentante criado: ', $apresentante->toArray());

            // Criar o protocolo relacionando ao apresentante
            $protocolo = Protocolo::create([
                'numero_documento' => $validated['numero_documento_protocolo'],
                'id_grupo' => $validated['id_grupo'],
                'id_apresentante' => $apresentante->id,
                'data_documento' => $validated['data_documento'],
                'data_abertura' => Carbon::now()->format('Y-m-d'),
                'data_cancelamento' => Carbon::now()->addDays(30)->format('Y-m-d'),
                'id_usuario' => auth()->user()->id,
                'id_especie' => $validated['id_especie'],
                'id_natureza' => $validated['id_natureza'],
            ]);

            $protocolo->refresh();

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

            return view('protocolos.index', compact('protocolo'))
                ->with('success', 'Protocolo salvo com sucesso!');

            // return redirect()->back()->with('success', 'Protocolo cadastrado!');
        } catch (\Exception $e) {
            Log::error('Erro ao criar protocolo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao cadastrar: ' . $e->getMessage());
        }
    }
    public function buscarPorNumero($numero)
    {
        $protocolo = Protocolo::with([
            'grupo',
            'especie',
            'natureza',
            'apresentante',
            'partes'
        ])->where('numero_protocolo', $numero)->first();

        if (!$protocolo) {
            Log::warning('Protocolo não encontrado para o número: ' . $numero);
            return response()->json(['erro' => 'Protocolo não encontrado'], 404);
        }

        // Formatar data_abertura para input type="date" se necessário
        $data_abertura = $protocolo->data_abertura;
        if ($data_abertura && strlen($data_abertura) > 10) {
            $data_abertura = substr($data_abertura, 0, 10);
        }

        // Garantir que partes seja array
        $partes = $protocolo->partes ? $protocolo->partes->values()->toArray() : [];

        Log::info('Retornando protocolo para view', [
            'numero' => $numero,
            'data_abertura' => $data_abertura,
            'protocolo' => $protocolo,
            'partes' => $partes
        ]);

        return response()->json([
            'id' => $protocolo->id,
            'numero_protocolo' => $protocolo->numero_protocolo,
            'numero_registro' => $protocolo->numero_registro,
            'numero_documento' => $protocolo->numero_documento,
            'data_documento' => $protocolo->data_documento,
            'data_abertura' => $data_abertura,
            'data_cancelamento' => $protocolo->data_cancelamento,
            'data_retirada' => $protocolo->data_retirada,
            'data_registro' => $protocolo->data_registro,
            'id_grupo' => $protocolo->id_grupo,
            'id_natureza' => $protocolo->id_natureza,
            'id_especie' => $protocolo->id_especie,
            'apresentante' => $protocolo->apresentante,
            'partes' => $partes
        ]);
    }


    public function atualizarDataRetirada($numero)
    {
        try {
            $protocolo = Protocolo::where('numero_protocolo', $numero)->first();
            if (!$protocolo) {
                return response()->json(['erro' => 'Protocolo não encontrado'], 404);
            }
            $protocolo->data_retirada = Carbon::now()->format('Y-m-d');
            $protocolo->save();
            return response()->json(['mensagem' => 'Data de retirada atualizada com sucesso', 'protocolo' => $protocolo]);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar data de retirada: ' . $e->getMessage());
            return response()->json(['erro' => 'Erro ao atualizar data de retirada'], 500);
        }
    }


    // TODO:ARRUMAR
   public function buscarIndices(Request $request)
{
    $query = Protocolo::query()->with(['grupo', 'natureza', 'especie']);

    if ($request->filled('grupo')) {
        $query->whereHas('grupo', function ($q) use ($request) {
            $q->where('sigla', $request->grupo);
        });
    }

    if ($request->filled('natureza')) {
        $query->where('id_natureza', $request->natureza);
    }

    if ($request->filled('especie')) {
        $query->whereHas('especie', function ($q) use ($request) {
            $q->where('nome', 'like', '%' . $request->especie . '%');
        });
    }

    if ($request->filled('numero_registro')) {
        $query->where('numero_registro', $request->numero_registro);
    }

    if ($request->filled('documento') && $request->filled('numero_documento')) {
        $query->whereHas('apresentante', function ($q) use ($request) {
            $q->where('id_documento', $request->documento)
              ->where('numero_documento', $request->numero_documento);
        });
    }

    if ($request->filled('nome')) {
        $query->whereHas('apresentante', function ($q) use ($request) {
            $q->where('nome', 'like', '%' . $request->nome . '%');
        });
    }

    $protocolo = $query->first();

    if (!$protocolo) {
        return response()->json(['erro' => 'Nenhum protocolo encontrado.'], 404);
    }

    return response()->json([
        'numero_protocolo' => $protocolo->numero_protocolo,
        'grupo' => $protocolo->grupo->sigla ?? '',
        'natureza' => $protocolo->natureza->nome ?? '',
        'data_documento' => $protocolo->data_documento,
    ]);
}


}
