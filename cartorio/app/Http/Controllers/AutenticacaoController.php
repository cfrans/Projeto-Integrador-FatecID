<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Protocolo;
use App\Models\Autenticacao;

class AutenticacaoController extends Controller
{
    public function index($protocolo)
    {
        $protocolo = Protocolo::with(['grupo', 'apresentante'])->where('numero_protocolo', $protocolo)->firstOrFail();
        return view('autenticacao.index', compact('protocolo'));
    }

    public function store(Request $request)
    {
        $dados = $request->all();

        $dados['valor'] = str_replace(',', '.', $dados['valor']);

        // Buscar o id do protocolo a partir do numero_protocolo
        if (!empty($dados['id_protocolo'])) {
            $protocolo = \App\Models\Protocolo::where('numero_protocolo', $dados['id_protocolo'])->first();
            if ($protocolo) {
                $dados['id_protocolo'] = $protocolo->id;
            } else {
                return back()->withErrors(['id_protocolo' => 'Protocolo não encontrado.']);
            }
        }

        \Log::info('Dados recebidos para autenticação:', $dados);

        try {
            $validated = \Validator::make($dados, [
                'valor' => 'required|numeric|min:0',
                'data_autenticacao'=> 'nullable|string',
                'numero_cheque' => 'nullable|integer',
                'agencia' => 'nullable|string|max:6',
                'conta' => 'nullable|string|max:15',
                'banco' => 'nullable|string|max:30',
                'id_protocolo' => 'required|exists:protocolo,id',
                'id_forma_pagamento' => 'required|exists:forma_pagamento,id',
            ])->validate();
            \Log::info('Dados validados:', $validated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Erro de validação:', $e->errors());
            throw $e;
        }

        $data = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['data_autenticacao'])->format('Y-m-d');

        $autenticacao = Autenticacao::create([
            'valor' => $validated['valor'],
            'data_autenticacao' => $data,
            'numero_cheque' => $validated['numero_cheque'] ?? null,
            'agencia' => $validated['agencia'] ?? null,
            'conta' => $validated['conta'] ?? null,
            'banco' => $validated['banco'] ?? null,
            'id_usuario' => auth()->user()->id,
            'id_protocolo' => $validated['id_protocolo'],
            'id_forma_pagamento' => $validated['id_forma_pagamento'],
        ]);

        return redirect()->back()->with('success', 'Autenticação salva com sucesso!');
    }
}

