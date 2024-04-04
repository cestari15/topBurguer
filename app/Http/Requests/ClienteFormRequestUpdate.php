<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteFormRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|max:120|min:5',
            'telefone' => 'required|numeric|max:99999999999|min:1000000000',
            'email'  => 'required|max:120|email',
            'password' => ''
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'error' => $validator->errors()
            ])
        );
    }

    public function messages()
    {
        return [
            'nome.required' => 'Preencha o campo nome',
            'nome.max' => 'Este campo deve conter no maximo 120 caractéris',
            'nome.min' => 'Este campo deve conter no minimo 5 caractéris',
        
            'telefone.required' => 'Preencha o campo telefone',
            'telefone.max' => 'Este campo deve conter no maximo 14 caractéris',
            'telefone.min' => 'Este campo deve conter no minimo 10 caractéris',
            'telefone.numeric' => 'O campo telefone deve conter apenas números.',
        
            'email.required' =>  'email obrigatório',
            'email.email' => 'formato inválido',
            'email.unique' => 'email já cadastrado no sistema',
            'email.max' => 'Este campo deve conter no maximo 120 caractéris',
        
            'endereco.required' => 'o campo endereço é obrigatório',
            'endereco.max' => 'o campo endereço deve ter no máximo 120 caractéris',
            'endereco.min' => 'o campo endereço deve ter no minimo 10 caractéris',
        
            
        ];
    }
}
