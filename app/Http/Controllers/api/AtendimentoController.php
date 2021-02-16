<?php

namespace App\Http\Controllers\api;

use App\Model\Atendimento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AtendimentoFormRequest;

class AtendimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $atendimentos = Atendimento::all();

            if (count($atendimentos) == 0):
                return response()->json(['message' => 'Nenhum Registro Encontrado.']);
            endif;
            return $atendimentos->toJson();
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AtendimentoFormRequest $request)
    {
        try {
            $atendimento = new Atendimento;
            $atendimento->cliente = $request->cliente;
            $atendimento->funcionario = $request->funcionario;
            $atendimento->tipo = $request->tipo;
            $atendimento->observacao = $request->observacao;
            $atendimento->data_execucao = $request->data_execucao;
            $atendimento->save();
            return response()->json(['message' => 'Atendimento registrada com êxito!']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $atendimento = new Atendimento;
            $atendimento = $atendimento->find($id);
            if ($atendimento):
               return response()->json($atendimento);
            else:
                return response()->json(['message' => "Registro de Nº $id não existe!"]);
            endif;
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AtendimentoFormRequest $request, $id)
    {
        try {
            $atendimento = new Atendimento;
            $dados = $request->all();
            $atendimento = $atendimento->find($id);
            $update = $atendimento->update($dados);
            if ($update):
                return response()->json(['message' => 'Atendimento atualizado com êxito!']);
            else:
                return response()->json(['message' => 'Os dados não foram atualizados!']);
            endif;
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $atendimento = new Atendimento;
            $delete = $atendimento->where('id', $id)->delete();
            if ($delete):
                return response()->json(['message' => "Atendimento N° $id foi excluído com sucesso!"]);
            else:
                return response()->json(['message' => "Registro de Nº $id não existe!"]);
            endif;
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
}
