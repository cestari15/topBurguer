<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarrinhoFormRequest extends FormRequest
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
            'clientes_id' => 'required|integer',
            'status' => 'required|',
            'total' => 'required|decimal:2'
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
            'clientes_id.required' => 'Preencha o campo Clientes',
            'Clientes_id.id.integer' => 'O campo Clientes só recevbe numeros inteiros',
            'status.required' => 'Preencha o campo status',
            'total.required' => 'Preencha o campo total',
            'total.decimal' => 'O campo total só aceita numeros decimais',
        ];
    }
}
