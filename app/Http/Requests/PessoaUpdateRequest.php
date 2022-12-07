<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaUpdateRequest extends FormRequest
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
            //
            'nome' => 'required|min:2|max:80',
            'sobrenome' => 'required|min:2|max:100',
            'cpf' => "required|numeric|digits:11|unique:pessoas,cpf",
            'celular' => "nullable|string|min:8|max:20",
            'logradouro' => "required|string|min:8|max:120",
            'cep' => "required|string|min:8|max:20"
        ];
    }
}
