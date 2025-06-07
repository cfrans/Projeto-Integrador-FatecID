<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Andamento;
use App\Models\Protocolo;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;

class AndamentoController extends Controller
{
    public function create(Request $request)
{
    $numeroProtocolo = $request->query('numero_protocolo');

    $andamentos = [];
    $protocolo = null;

    if ($numeroProtocolo) {
        $protocolo = Protocolo::where('numero_protocolo', $numeroProtocolo)->first();

        if ($protocolo) {
            $andamentos = Andamento::where('id_protocolo', $protocolo->id)
                ->with('usuario')
                ->get();
        }
    }

    return view('andamento.index', compact('numeroProtocolo', 'andamentos'));
}


    public function store(Request $request)
    {
        $dados = $request->all();

        // Buscar protocolo
        $protocolo = Protocolo::where('numero_protocolo', $dados['numero_protocolo'])->first();
        if (!$protocolo) {
            return back()->withErrors(['numero_protocolo' => 'Protocolo não encontrado.']);
        }

        $qtde = count($dados['id_tipo_andamento'] ?? []);

        for ($i = 0; $i < $qtde; $i++) {
            $dataHora = $dados['data_hora'][$i] ?? null;
            if (!$dataHora) {
                continue; // ou tratar erro
            }

            $validated = Validator::make([
                'valor' => str_replace(',', '.', $dados['valor'][$i]),
                'data_hora' => $dataHora,
                'id_protocolo' => $protocolo->id,
                'observacao' => $dados['observacao'][$i] ?? null,
                'id_tipo_andamento' => $dados['id_tipo_andamento'][$i],
            ], [
                'valor' => 'required|numeric|min:0',
                'data_hora' => 'required|string',
                'id_protocolo' => 'required|exists:protocolo,id',
                'observacao' => 'nullable|string|max:255',
                'id_tipo_andamento' => 'required|exists:tipo_andamento,id',
            ])->validate();

            Andamento::create([
                'valor' => $validated['valor'],
                'data_hora' => \Carbon\Carbon::createFromFormat('d/m/Y', $validated['data_hora'])->format('Y-m-d'),
                'id_usuario' => auth()->user()->id,
                'id_protocolo' => $validated['id_protocolo'],
                'id_tipo_andamento' => $validated['id_tipo_andamento'],
                'observacao' => $validated['observacao'] ?? null,
            ]);
        }

        return redirect()->route('andamento.index', ['numero_protocolo' => $dados['numero_protocolo']])
                         ->with('success', 'Andamento(s) cadastrado(s)!');
    }

   public function index(Request $request)
{
    $numeroProtocolo = $request->query('numero_protocolo');

    $andamentos = [];

    if ($numeroProtocolo) {
        $protocolo = Protocolo::where('numero_protocolo', $numeroProtocolo)->first();
        if ($protocolo) {
            $andamentos = Andamento::where('id_protocolo', $protocolo->id)->with('usuario')->get();
        }
    }

    return view('andamento.index', compact('numeroProtocolo', 'andamentos'));


}

}

