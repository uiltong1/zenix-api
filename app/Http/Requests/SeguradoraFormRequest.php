<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeguradoraFormRequest extends FormRequest
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
                'no_seguradora' => 'required',
                'sg_seguradora' => 'required'
            ];
        } else {
            return [
                'no_seguradora' => 'required|unique:seguradoras',
                'sg_seguradora' => 'required|unique:seguradoras'
            ];
        }
    }

    public function messages()
    {
        $messages = [
            'no_seguradora.required' => 'Nome da seguradora é obrigatório',
            'no_seguradora.unique' => 'Seguradora já está cadastrada.',
            'sg_seguradora.required' => 'Sigla da seguradora é obrigatório.',
            'sg_seguradora.unique' => 'Sigla já cadastrada.'
        ];

        return $messages;
    }
}
