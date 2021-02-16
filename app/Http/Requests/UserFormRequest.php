<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
    public static function rules()
    {

        if (request()->method() == 'PUT') {
            return [
                'name' => 'required|max:256',
                'email' => 'required|max:255',
                'cpf' => 'required|cpf|formato_cpf|max: 14'
            ];
            
        } else {

            return [
                'name' => 'required|max: 255',
                'email' => 'required|max:255|unique:users',
                'cpf' => 'required|cpf|formato_cpf|max: 14|unique:users',
                // 'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/',
            ];
        }
    }
    public function messages()
    {
        $messages = [
            'cpf.unique' => 'CPF já cadastrado',
            'name.required' => 'Nome obrigatório.',
            'name.max' => 'Nome deve conter no máximo 255 caracteres.',
            'email.required' => 'Email é obrigatório.',
            'email.max' => 'O campo email deve conter no máximo 255 caracteres',
            'email.unique' => 'Email já cadastrado.',
            // 'password.required' => 'A senha deve conter no minímo 8 caracteres',
            // 'password.regex' => 'A senha deve conter no mínimo oito caracteres, pelo menos, uma letra maiúscula, uma letra minúscula, um número e um caractere especial',
        ];

        return $messages;
    }
}
