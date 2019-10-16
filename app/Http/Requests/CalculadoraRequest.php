<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CalculadoraRequest extends FormRequest
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

    public function isJson()
    {
        return true;
    }

    public function wantsJson()
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
        return [
            'investimentos' => 'required|array',
            'investimentos.*.codigo' => 'required|max:6',
            'investimentos.*.quantidade' => 'required|integer',
            'investimentos.*.data_inicial' => 'required|date|before:tomorrow',
            'investimentos.*.data_final' => 'required|date|after:investimentos.*.data_inicial|before:tomorrow',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'investimentos.*.codigo' => 'Ticker',
            'investimentos.*.quantidade' => 'Quantidade',
            'investimentos.*.data_inicial' => 'Data Inicial',
            'investimentos.*.data_final' => 'Data Final'
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'investimentos.required' => 'Os dados não foram enviados da forma adequada. Observe a documentação e refaça a chamada.',
            'required' => 'O campo :attribute não pode estar vazio',
            'date' => 'O campo :attribute deve ser uma data válida',
            'before:tomorrow' => 'A :attribute deve ser uma data válida e não pode ser maior que hoje ',
            'investimentos.*.codigo.max' => 'O :attribute deve ter no máximo 6 caracteres',
            'investimentos.*.quantidade.integer' => 'A :attribute deve ser um número inteiro',
            'investimentos.*.data_final.after:investimentos.*.data_final' => 'A :attribute deve ser uma data após a data inicial'
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
