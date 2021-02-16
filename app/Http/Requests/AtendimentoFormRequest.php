<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtendimentoFormRequest extends FormRequest
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
        return [
            'cliente' => 'required|max: 255',
            'funcionario' => 'required',
            'tipo' => 'required',
            'observacao' => 'required'
        ];
    }
    public function messages(){
        return [
            'cliente.required'=>'Campo cliente obrigatório.',
            'cliente.max' => 'Campo cliente deve conter no máximo 255 caracteres.',
            'funcionario.required' => 'Campo funcionário é obrigatório.',
            'tipo.required'=>'O campo tipo é obrigatório',
            'observacao.required' => 'O campo observação é obrigatório'
        ];
    }
}
