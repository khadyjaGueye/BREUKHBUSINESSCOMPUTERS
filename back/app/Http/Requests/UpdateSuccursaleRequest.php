<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSuccursaleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "nom" =>'required',
            "adresse" => 'required',
            "telephone" => 'required|unique:succursales',
            "reduction" => 'default:0',
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'error'=>true,
            'message'=>'Erreur de validation',
            'errorsList'=>$validator->errors()
        ]));
    }
    public function messages(){
        return [
            'nom.required'=>'Un nom doit être fourni',
            'adresse.required'=>'L\'adresse doit être fourni',
            'telephone.required'=>'Le numero telephone doit être fourni',
            'reduction.required'=>'Le role doit être fourni',
        ];
    }
}
