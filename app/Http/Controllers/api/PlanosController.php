<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanoFormRequest;
use Illuminate\Http\Request;
use App\Model\Plano;
use App\Model\Seguradora;
use App\Model\TipoPlano;
use Exception;

class PlanosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planos = Plano::Select('planos.id', 'planos.no_plano', 'tipo_planos.no_tipo_plano', 'seguradoras.sg_seguradora', 'planos.status')
            ->leftjoin('tipo_planos', 'planos.id_tipo_plano', '=', 'tipo_planos.id')
            ->leftjoin('seguradoras', 'planos.id_seguradora', '=', 'seguradoras.id')
            ->get();

        $tipos_planos = TipoPlano::Select('id', 'no_tipo_plano')
            ->where('status', '=', 1)
            ->get();

        $seguradoras = Seguradora::Select('id', 'sg_seguradora')
            ->where('status', '=', 1)
            ->get();

        $response = array();
        $response['planos'] = $planos;
        $response['campos']['tipos_planos'] = $tipos_planos;
        $response['campos']['seguradoras'] = $seguradoras;
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $tipos_planos = TipoPlano::Select('id', 'no_tipo_plano')
                ->where('status', '=', 1)
                ->get();

            $seguradoras = Seguradora::Select('id', 'sg_seguradora')
                ->where('status', '=', 1)
                ->get();

            $response = array();
            $response['campos']['tipos_planos'] = $tipos_planos->toArray();
            $response['campos']['seguradoras'] = $seguradoras->toArray();
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
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
        try {
            $plano = new Plano();
            $plano->no_plano = $request->no_plano;
            $plano->detalhes = $request->detalhes;
            $plano->id_seguradora = $request->id_seguradora;
            $plano->id_tipo_plano = $request->id_tipo_plano;
            $plano->status = $request->status;
            $plano->contrato = $request->contrato;
            $result = $plano->save();
            $result = $plano->where('no_plano', $request->no_plano)->first();
            $data = $result->id;
            return response()->json(['message' => 'Plano cadastrado com sucesso.', 'data' => $data]);
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
        try {
            if (!$id)
                abort(404, 'Código do plano não informado.');

            $plano = Plano::find($id);
            $tipos_planos = TipoPlano::Select('id', 'no_tipo_plano')
                ->where('status', '=', 1)
                ->get();

            $seguradoras = Seguradora::Select('id', 'sg_seguradora')
                ->where('status', '=', 1)
                ->get();

            $response = array();
            $response['plano'] = $plano;
            $response['campos']['tipos_planos'] = $tipos_planos->toArray();
            $response['campos']['seguradoras'] = $seguradoras->toArray();
            return response()->json($response);
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
    public function update(Request $request, $id)
    {
        try {
            $plano = Plano::find($id);
            $plano->no_plano = $request->no_plano;
            $plano->detalhes = $request->detalhes;
            $plano->id_seguradora = $request->id_seguradora;
            $plano->id_tipo_plano = $request->id_tipo_plano;
            $plano->status = $request->status;
            $plano->contrato = $request->contrato;
            $result = $plano->save();
            return response()->json(['message' => 'Plano atualizado com sucesso!']);
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
            $plano = Plano::find($id);
            if (!empty($plano)) {
                if ($plano->status == 2)
                    $plano->status = 1;
                else if ($plano->status ==  1)
                    $plano->status = 2;
                else
                    $plano->status = 1;
                $plano->save();
                return response()->json(['message' => 'Plano atualizado com sucesso.']);
            } else {
                return response()->json(['message' => 'Plano não encontrado.']);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }
}
