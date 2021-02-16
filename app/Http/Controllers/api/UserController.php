<?php

namespace App\Http\Controllers\API;

use App\Exports\UserCustomFromView;
use App\Http\Controllers\api\PessoaController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pessoa\PessoaFormRequest;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserFormRequest;
use App\Model\Pessoa;
use DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::orderBy('users.id')
            ->select('users.id', 'users.name', 'users.email', 'users.id_status as status')
            ->get();
        $users = collect($users);
        return response()->json($users);
    }

    public function registerUser(UserFormRequest $request)
    {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->id_status = $request->id_status ? $request->id_status : 1;
            $user->cpf = $request->cpf;
            $user->password = Hash::make('padrao');
            $user->save();
            $result = $user->where('cpf', $request->cpf)->first();
            $data = $result->id;
            return response()->json(['message' => 'Salvo com sucesso!', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }

    public function edit($id)
    {
        try {
            $users = new User();
            $user = $users->find($id);
            if (!empty($user)) {
                return response()->json($user);
            }
            return response()->json(['message' => 'Usuário não encontrado.']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function update(UserFormRequest $request, $id)
    {
        try {
            $result = DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'id_status' => $request->id_status,
                    'cpf' => $request->cpf
                ]);
            return response()->json(['message' => 'Usuario atualizado com sucesso.']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function toggle($id)
    {
        try {
            $user = User::find($id);
            if (!empty($user)) {
                if ($user->id_status == 2)
                    $user->id_status = 1;
                else if ($user->id_status ==  1)
                    $user->id_status = 2;
                else
                    $user->id_status = 1;
                $user->save();
                return response()->json(['message' => 'Usuário atualizado com sucesso.']);
            } else {
                return response()->json(['message' => 'Usuário não encontrado.']);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function show($id)
    {
        try {
            $user = User::leftjoin('status', 'users.id_status', '=', 'status.id')
                         ->where('users.id', $id)->get();
            if (count($user) == 0)
                return response()->json(['message' => 'Usuário não encontrado.']);
            else
                $user = collect($user);
                return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function search(Request $request){
        try{
            $user = User::all();
        $user = $user->where('name','ilike',$request->name);        
            return response()->json(['data' => $user]);
        } catch (Exception $e){
            return response()->json(['message' => $e]);
        }
    }

    public function export() 
    {
        return Excel::download(new UserCustomFromView, 'users.xlsx');
    }
}
