<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusVendaFormRequest;
use App\Model\StatusVenda;
use Exception;
use Illuminate\Http\Request;

class StatusVendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $status_vendas = StatusVenda::all();
            return response()->json($status_vendas);
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
    public function store(StatusVendaFormRequest $request)
    {
        try {
            $statusVenda = new StatusVenda();
            $statusVenda->no_status_venda = $request->no_status_venda;
            if($request->status != ''){
                $statusVenda->status = $request->status;
            }else {
                $statusVenda->status = 1;
            }
            $statusVenda->save();

            $result = $statusVenda->where('no_status_venda', '=', $request->no_status_venda)->first();
            $data = $result->id;
            return response()->json(['message' => 'Status cadastrado com sucesso.', 'data' => $data]);
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
        try{
            $status_venda = StatusVenda::find($id);
            if(empty($status_venda)){
                return response(['message' => 'Status de venda não encontrado.'], 404);
            }
            $date = date_format($status_venda->created_at, 'd/m/Y');
            $status_venda->date = $date; 
            return response()->json($status_venda);
        } catch (Exception $e) {
            response()->json(['message' => $e]);
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
        try{
            $status_venda = StatusVenda::find($id);
            if(empty($status_venda)){
                return response(['message' => 'Status de venda não encontrado.'], 404);
            }
            return response()->json($status_venda);
        } catch (Exception $e) {
            response()->json(['message' => $e]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $statusVenda = StatusVenda::find($id);
            if(empty($statusVenda)){
                return response(['message' => 'Status não foi encontrado'], 404);
            }
            $statusVenda->no_status_venda = $request->no_status_venda;
            if($request->status != ''){
                $statusVenda->status = $request->status;
            }else {
                $statusVenda->status = 1;
            }
            $statusVenda->save();
            return response()->json(['message' => 'Status de venda atualizado com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
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
        //
    }

    public function toggle($id)
    {
        try {
            $status_venda = new StatusVenda();
            $status_venda = $status_venda->find($id);
            if(empty($status_venda)){
                return response(['message' => 'Status não encontrado.'], 404);
            }
            
            if($status_venda->status == 1){
                $status_venda->status = 2;
            } else if($status_venda-> status == 2){
                $status_venda->status = 1;
            } else {
                $status_venda->status = 1;
            }
            $status_venda->save();
            return response()->json(['message' => 'Status alterado com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }
}
