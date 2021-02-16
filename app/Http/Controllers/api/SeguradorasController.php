<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeguradoraFormRequest;
use App\Model\Seguradora;
use Exception;
use Illuminate\Http\Request;

class SeguradorasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seguradora = Seguradora::all();

        return response()->json($seguradora);
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
    public function store(SeguradoraFormRequest $request)
    {
        try {
            $seguradora = new Seguradora();
            $seguradora->no_seguradora = $request->no_seguradora;
            $seguradora->sg_seguradora = $request->sg_seguradora;
            if($request->status == ''){
                $request->status = 1;
            }
            $seguradora->status = $request->status;
            $seguradora->save();
            $result = $seguradora->where('no_seguradora', $request->no_seguradora)->first();
            $data = $result->id;
            return response()->json(['message' => 'Seguradora cadastrada com sucesso.', 'data' => $data]);
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
            $seguradora = Seguradora::select('seguradoras.id', 'seguradoras.no_seguradora', 'seguradoras.sg_seguradora', 'status.no_status', 'seguradoras.created_at')
                                    ->leftjoin('status', 'seguradoras.status', '=', 'status.id')
                                    ->where('seguradoras.id', '=', $id)->first();

            if (empty($seguradora)) {
                return response()->json(['message' => 'Seguradora não encontrado.']);
            }
            $date = date_format($seguradora->created_at, 'd/m/Y');
            $seguradora->date = $date; 
            return response()->json($seguradora);
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
            $seguradoras = new Seguradora();
            $seguradora = $seguradoras->find($id);
            if (!empty($seguradora)) {
                return response()->json($seguradora);
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
    public function update(SeguradoraFormRequest $request, $id)
    {
        $seguradora = Seguradora::find($id);

        if(empty($seguradora)){
            return response()->json(['message' => 'Seguradora não encontrada.']);
        }

        $seguradora->no_seguradora = $request->no_seguradora;
        $seguradora->sg_seguradora = $request->sg_seguradora;
        $seguradora->status = $request->status;
        $seguradora->save();
        return response()->json(['message' => 'Seguradora atualizada com sucesso.']);
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
            $seguradora = new Seguradora();
            $seguradora = $seguradora->find($id);
            if(empty($seguradora)){
                return response()->json(['message' => 'Seguradora não encontrada']);
            }
            
            if($seguradora->status == 1){
                $seguradora->status = 2;
            } else if($seguradora-> status == 2){
                $seguradora->status = 1;
            } else {
                $seguradora->status = 1;
            }
            $seguradora->save();
            return response()->json(['message' => 'Status da seguradora alterado com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }
}
