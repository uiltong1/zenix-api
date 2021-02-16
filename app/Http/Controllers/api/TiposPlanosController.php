<?php

namespace App\Http\Controllers\Api;

use App\Model\TipoPlano;
use App\Http\Controllers\Controller;
use App\Http\Requests\TiposPlanosFormRequest;
use Illuminate\Http\Request;
use Exception;

class TiposPlanosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tipos_planos = TipoPlano::all();
            return response()->json($tipos_planos);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TiposPlanosFormRequest $request)
    {
        try {
            $tipos_planos = new TipoPlano();
            $tipos_planos->no_tipo_plano = $request->no_tipo_plano;
            $tipos_planos->status = $request->status;
            $result = $tipos_planos->save();
            $result = $tipos_planos->where('no_tipo_plano', $request->no_tipo_plano)->first();
            $data = $result->id;
            return response()->json(['message' => 'Tipo de plano cadastrada com sucesso.', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
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
            $tipo_plano = TipoPlano::where('tipo_planos.id', '=', $id)
                ->leftjoin('status', 'tipo_planos.status', '=', 'status.id')->first();
            if (empty($tipo_plano)) {
                return response()->json(['message' => 'Tipo de plano não encontrado.']);
            }
            if($tipo_plano->created_at){
                $date = date_format($tipo_plano->created_at, 'd/m/Y');
                $tipo_plano->date = $date; 
            }
            return response()->json($tipo_plano);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
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
        try {
            $tipos_planos = new TipoPlano();
            $tipo_plano = $tipos_planos->find($id);
            if (!empty($tipo_plano)) {
                return response()->json($tipo_plano);
            }
            return response()->json(['message' => 'Seguradora não encontrado.']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TiposPlanosFormRequest $request, $id)
    {
        $tipo_plano = TipoPlano::find($id);

        if(empty($tipo_plano)){
            return response()->json(['message' => 'Tipo de plano não encontrado.']);
        }

        $tipo_plano->no_tipo_plano = $request->no_tipo_plano;
        $tipo_plano->status = $request->status;
        $tipo_plano->save();
        return response()->json(['message' => 'Tipo de plano atualizado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function toggle($id)
    {
        try {
            $tipos_planos = new TipoPlano();
            $tipos_planos = $tipos_planos->find($id);
            if(empty($tipos_planos)){
                return response(['message' => 'Tipo de não encontrado.'], 404);
            }
            
            if($tipos_planos->status == 1){
                $tipos_planos->status = 2;
            } else if($tipos_planos-> status == 2){
                $tipos_planos->status = 1;
            } else {
                $tipos_planos->status = 1;
            }
            $tipos_planos->save();
            return response()->json(['message' => 'Status alterado com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }
}
