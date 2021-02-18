<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Model\PlanoPrecos;
use App\Model\Plano;
use Illuminate\Http\Request;
use Exception;


class PlanoPrecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        try {
            if (!$request->filled('id')) {
                abort(412, 'Código do plano não informado.');
            }
            if (empty($request->prices)) {
                abort(412, 'Preço(s) não informado.');
            }

            $planos_precos = PlanoPrecos::where('id_plano', $request->id)->get();
            if (!empty($planos_precos)) {
                PlanoPrecos::where('id_plano', $request->id)->delete();
            }

            $id = $request->id;
            $precos = $request->prices;

            foreach ($precos as $value) {
                $plano = new PlanoPrecos();
                $plano->id_plano = $id;
                $plano->idade_inicio = $value['idade_inicio'];
                $plano->idade_fim = $value['idade_fim'];
                $plano->preco = $value['preco'];
                $plano->vl_comissao = $value['vl_comissao'];
                $plano->qt_comissao = $value['qt_comissao'];
                $plano->status = 1;
                $plano->save();
            }
            return response()->json(['message' => 'Preços atualizados com sucesso!']);
        } catch (Exception $e) {
            return response()->json($e);
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
        //
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
            if(!$id)
                abort(404, 'Código do plano não informado.');
            
            $prices = PlanoPrecos::where('id_plano', $id)->get();
            
            $response = array();
            $response['prices'] = $prices;
            return response()->json($response);
        }catch(Exception $e){
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
    public function update(Request $request, $id)
    {
        //
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
}
