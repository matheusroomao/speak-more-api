<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CalculateRequest extends FormRequest
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
            'origin' => ['required', 'integer', 'exists:App\Models\Code,id','different:destiny'],
            'destiny' => ['required', 'integer', 'exists:App\Models\Code,id','different:origin'],
            'time' => ['required','numeric'],
            'plan_id' => ['required', 'integer', 'exists:App\Models\Plan,id'],
        ];
    }
    public function messages()
    {
        return [
            'origin.required' => 'O campo origem é obrigatório.',
            'destiny.required' => 'O campo destino é obrigatório.',
            'time.required' => 'O campo tempo é obrigatório.',
            'plan_id.required' => 'O campo plano é obrigatório.',
            'origin.different' => 'Informe a origem diferente do destino',

        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()->first()], 422));
    }
}
