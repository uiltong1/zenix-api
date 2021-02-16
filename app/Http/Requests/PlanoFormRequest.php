<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->method() == 'PUT') {
            return [
                'no_plano' => 'required',
                'id_seguradora' => 'required',
                'id_tipo_plano' => 'required',
                'contrato' => 'required'
            ];
        } else {
            return [
                'no_plano' => 'required|unique:planos',
                'id_seguradora' => 'required',
                'id_tipo_plano' => 'required',
                'contrato' => 'required'
            ];
        }
    }
    public function messages()
    {
        $messages = [
            'no_plano.required' => 'Nome do plano não foi informado.',
            'no_plano.unique' => 'Nome do plano já cadastrado.',
            'id_seguradora.required' => 'Seguradora não informada.',
            'id_tipo_plano.required' => 'Tipo de plano não informado.',
            'contrato.required' => 'Tipo de contratação não informado.'
        ];

        return $messages;
    }
}
