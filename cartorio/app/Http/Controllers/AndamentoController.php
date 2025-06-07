<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Andamento;
use App\Models\Protocolo;
use App\Models\TipoParte;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        $dados = $request->all();

        $dados['valor'] = str_replace(',', '.', $dados['valor']);

        // Buscar o id do protocolo a partir do numero_protocolo
        if (!empty($dados['numero_protocolo'])) {
            $protocolo = Protocolo::where('numero_protocolo', $dados['numero_protocolo'])->first();
            if ($protocolo) {
                $dados['id_protocolo'] = $protocolo->id;
            } else {
                return back()->withErrors(['numero_protocolo' => 'Protocolo não encontrado.']);
            }
        }

        Log::info('Dados recebidos para andamento:', $dados);

         try {
            $validated = Validator::make($dados, [
                'valor' => 'required|numeric|min:0',
                'data_hora'=> 'nullable|string',
                'id_protocolo' => 'required|exists:protocolo,id',
                'observacao' => 'nullable|string|max:255',
                'id_tipo_andamento' => 'required|exists:tipo_andamento,id',
            ])->validate();
            Log::info('Dados validados:', $validated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Erro de validação:', $e->errors());
            throw $e;
        }

        $data = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['data_hora'])->format('Y-m-d');

        Andamento::create([
            'valor' => $validated['valor'],
            'data_hora' => $data,
            'id_usuario' => auth()->user()->id,
            'id_protocolo' => $validated['id_protocolo'],
            'id_tipo_andamento' => $validated['id_tipo_andamento'],
            'observacao' => $validated['observacao'] ?? null,
        ]);
        return redirect()->back()->with('success', 'Andamento cadastrado!');
    }
    public function index(Request $request)
    {
        $numeroProtocolo = $request->query('numero_protocolo');
        $andamentos = [];

        if ($numeroProtocolo) {
            $protocolo = \App\Models\Protocolo::where('numero_protocolo', $numeroProtocolo)->first();
            if ($protocolo) {
                $andamentos = \App\Models\Andamento::where('id_protocolo', $protocolo->id)->get();
            }
        } else {
            $andamentos = \App\Models\Andamento::all();
        }

        return view('andamento.index', compact('numeroProtocolo'));
    }
}
