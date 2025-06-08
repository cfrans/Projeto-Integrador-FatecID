<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Andamento;
use App\Models\Protocolo;
use App\Models\Usuario; // Garanta que este Model existe e está correto
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // Adicionado do branch 'main'

class AndamentoController extends Controller
{
    /**
     * Exibe a página de andamento com a lista de andamentos para um protocolo específico.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
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
            } else {
                Log::info('AndamentoController@index: Protocolo não encontrado para o número: ' . $numeroProtocolo);
            }
        }

        return view('andamento.index', [
            'numeroProtocolo' => $numeroProtocolo,
            'andamentos' => $andamentos,
            'protocolo' => $protocolo,
            'data_retirada' => $protocolo->data_retirada ?? null,
        ]);
    }

    /**
     * Armazena um ou mais novos andamentos para um protocolo.
     * Inclui lógica de transação de banco de dados e atualização de protocolo.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        // Validação inicial do número do protocolo principal
        $validatorProtocolo = Validator::make($dados, [
            'numero_protocolo' => 'required|exists:protocolo,numero_protocolo',
        ]);

        if ($validatorProtocolo->fails()) {
            Log::warning('AndamentoController@store: Validação do protocolo principal falhou.', $validatorProtocolo->errors()->toArray());
            return response()->json(['success' => false, 'message' => 'Protocolo inválido ou não encontrado.', 'errors' => $validatorProtocolo->errors()], 422);
        }

        $protocolo = Protocolo::where('numero_protocolo', $dados['numero_protocolo'])->first();

        $andamentosSalvosCount = 0;
        $errorsOccurred = false;

        $qtde = count($dados['id_tipo_andamento'] ?? []);
        if ($qtde === 0) {
            Log::warning('AndamentoController@store: Nenhuma linha de andamento para cadastrar.');
            return response()->json(['success' => false, 'message' => 'Nenhum andamento para cadastrar.'], 422);
        }

        DB::beginTransaction(); // Inicia a transação de banco de dados (do branch 'main')

        try {
            // Processa cada andamento enviado
            for ($i = 0; $i < $qtde; $i++) {
                $dataHora = $dados['data_hora'][$i] ?? null;
                $valorRaw = $dados['valor'][$i] ?? '0';

                // Pula o andamento se a data/hora estiver vazia (campo obrigatório)
                if (!$dataHora) {
                    Log::warning("AndamentoController@store: Data/Hora do andamento {$i} está vazia.", ['index' => $i]);
                    $errorsOccurred = true;
                    continue;
                }

                // Garante que o valor é numérico (float)
                $valorNumerico = (float) $valorRaw;

                $andamentoData = [
                    'valor' => $valorNumerico,
                    'data_hora' => $dataHora,
                    'id_protocolo' => $protocolo->id,
                    'observacao' => $dados['observacao'][$i] ?? null,
                    'id_tipo_andamento' => $dados['id_tipo_andamento'][$i] ?? null,
                    'id_usuario' => auth()->user()->id,
                ];

                $validator = Validator::make($andamentoData, [
                    'valor' => 'required|numeric|min:0',
                    'data_hora' => 'required|date_format:d/m/Y H:i', // Formato esperado do frontend
                    'id_protocolo' => 'required|exists:protocolo,id',
                    'id_tipo_andamento' => 'required|exists:tipo_andamento,id',
                    'observacao' => 'nullable|string|max:500',
                    'id_usuario' => 'required|exists:usuario,id', // Nome da tabela de usuários
                ]);

                if ($validator->fails()) {
                    Log::warning("AndamentoController@store: Validação do andamento {$i} falhou.", $validator->errors()->toArray());
                    $errorsOccurred = true;
                    continue;
                }

                // Tenta criar o registro de andamento
                $andamento = Andamento::create([ // Captura o andamento criado se precisar dele mais tarde
                    'valor' => $andamentoData['valor'],
                    // Converte para o formato de banco de dados (YYYY-MM-DD HH:MM:SS)
                    'data_hora' => Carbon::createFromFormat('d/m/Y H:i', $andamentoData['data_hora'])->format('Y-m-d H:i:s'),
                    'id_usuario' => $andamentoData['id_usuario'],
                    'id_protocolo' => $andamentoData['id_protocolo'],
                    'id_tipo_andamento' => $andamentoData['id_tipo_andamento'],
                    'observacao' => $andamentoData['observacao'],
                ]);
                $andamentosSalvosCount++;
                Log::info("AndamentoController@store: Andamento {$i} salvo com sucesso.");

                // Lógica de atualização de protocolo (do branch 'main')
                // Se for "Título Registrado"
                if ((int)$andamentoData['id_tipo_andamento'] === 1) { // Usamos $andamentoData aqui
                    // Atualizar data_registro
                    $protocolo->data_registro = Carbon::createFromFormat('d/m/Y H:i', $andamentoData['data_hora'])->format('Y-m-d'); // Usamos $andamentoData aqui

                    // Se ainda não tiver número de registro, gerar o próximo sequencial
                    if (!$protocolo->numero_registro) {
                        $ultimoNumero = Protocolo::max('numero_registro') ?? 0;
                        $protocolo->numero_registro = $ultimoNumero + 1;
                    }
                    $protocolo->save();
                    Log::info('AndamentoController@store: Protocolo atualizado com data_registro e/ou numero_registro.');
                }
            }

            DB::commit(); // Confirma a transação (do branch 'main')

            // Resposta final baseada no resultado das operações
            if ($andamentosSalvosCount > 0 && !$errorsOccurred) {
                Log::info('AndamentoController@store: Todos os andamentos foram salvos com sucesso.');
                return response()->json(['success' => true, 'message' => 'Andamento(s) cadastrado(s) com sucesso!'], 200);
            } elseif ($andamentosSalvosCount > 0 && $errorsOccurred) {
                Log::warning('AndamentoController@store: Alguns andamentos foram salvos, mas outros tiveram erros. Consulte os logs.');
                return response()->json(['success' => false, 'message' => "{$andamentosSalvosCount} andamento(s) salvo(s), mas alguns erros ocorreram. Consulte os logs."], 200);
            } else {
                Log::error('AndamentoController@store: Nenhum andamento foi salvo devido a erros. Consulte os logs.');
                return response()->json(['success' => false, 'message' => 'Nenhum andamento foi salvo. Verifique os dados fornecidos.'], 422);
            }
        } catch (\Exception $e) {
            DB::rollBack(); // Desfaz a transação em caso de erro (do branch 'main')
            Log::error('AndamentoController@store: Erro fatal na transação: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Erro interno do servidor ao salvar andamento(s).'], 500);
        }
    }
}
