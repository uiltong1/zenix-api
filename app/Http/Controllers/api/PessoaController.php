<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pessoa\PessoaFormRequest;
use App\Model\Funcionario;
use Exception;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\ExceptionMessage;

class FuncionarioController extends Controller
{

    public function index()
    {
        return Funcionario::all();
    }

    public function create(FuncionarioFormRequest $request)
    {
        try {
            $funcionario = new Funcionario;
            $funcionario->id = $request->id;
            $funcionario->cpf = $request->cpf;
            $funcionario->idade = $request->idade;
            $funcionario->telefone = $request->telefone;
            $funcionario->save();
            return response()->json(['message' => 'Dados registrados com êxito!']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'cpf' => 'required|cpf|formato_cpf|max: 14',
            ]);
            $funcionario = new Funcionario;
            $dados = $request->all();
            $funcionario = $funcionario->find($id);
            $update = $funcionario->update($dados);
            if ($update):
                return response()->json(['message' => 'Dados atualizados com êxito!']);
            else:
                return response()->json(['message' => 'Os dados não foram atualizados!']);
            endif;
        } catch (ExceptionMessage $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function destroy($id)
    {
        try {
            $funcionario = new Funcionario;
            $delete = $pessoa->where('id', $id)->delete();
            if ($delete):
                return response()->json(['message' => 'Dados excluídos com êxito!']);
            else:
                return response()->json(['message' => 'Os dados não foram excluídos!']);
            endif;
        } catch (ExceptionMessage $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
}
