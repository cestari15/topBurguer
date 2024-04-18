<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarrinhoFormRequestUpdate extends FormRequest
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
            'clientes_id'=>'integer',
            'produtos_id'=>'integer',
            'total'=>'|decimal:2'
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
         
            'clientes_id.id.integer'=>'O campo Clientes só recevbe numeros inteiros',

        
            'produtos_id.id.integer'=>'O campo Produtos só recevbe numeros inteiros',

          
        
            'total.decimal'=>'O campo total só aceita numeros decimais',

        ];
    }
}
