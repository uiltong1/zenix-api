<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TiposPlanosFormRequest extends FormRequest
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
                'no_tipo_plano' => 'required',
            ];
        } else {
            return [
                'no_tipo_plano' => 'required|unique:tipo_planos'
            ];
        }
    }

    public function messages()
    {
        $messages = [
            'no_tipo_plano.required' => 'Tipo de plano é obrigatório'
        ];

        return $messages;
    }
}
