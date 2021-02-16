<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusVendaFormRequest extends FormRequest
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
                'no_status_venda' => 'required',
            ];
        } else {
            return [
                'no_status_venda' => 'required|unique:status_vendas',
            ];
        }
    }

    public function messages()
    {
        $messages = [
            'no_status_venda.required' => 'Nome do status é obrigatório',
            'no_status_venda.unique' => 'Nome do status já está sendo utilizado.',
        ];

        return $messages;
    }
}
