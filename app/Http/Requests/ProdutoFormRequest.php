<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoFormRequest extends FormRequest
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
            'preco' => 'required|decimal:2,4',
            'ingredientes' => 'required|max:100|min:5',
            'imagem'=>'required'
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
            'imagem.required'=>'coloque uma imagem no campo',
            'nome.required' => 'Preencha o campo nome',
            'nome.max' => 'Este campo deve conter no maximo 120 caractéris',
            'nome.min' => 'Este campo deve conter no minimo 5 caractéris',

            'preco.required' => 'Preencha o campo preco',
            'preco.decimal' => 'Este campo recebe apenas numeros decimais ',

            'ingredientes.required' => 'Preencha o campo ingredientes',
            'ingredientes.max' => 'Este campo deve conter no maximo 100 caractéris',
            'ingredientes.min' => 'Este campo deve conter no minimo 5 caractéris',
        ];
    }
}
