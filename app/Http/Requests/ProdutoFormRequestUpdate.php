<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoFormRequestUpdate extends FormRequest
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
            'nome' => '|max:120|min:5',
            'preco' => '|decimal:2,4',
            'ingredientes' => '|max:100|min:5',
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

    
    public function messages(){
        return [
          
            'nome.max' => 'Este campo deve conter no maximo 120 caractéris',
            'nome.min' => 'Este campo deve conter no minimo 5 caractéris',

          
            'preco.decimal' => 'Este campo recebe apenas numeros decimais ',

         
            'ingredientes.max' => 'Este campo deve conter no maximo 100 caractéris',
            'ingredientes.min' => 'Este campo deve conter no minimo 5 caractéris',
        ];
    }
}
