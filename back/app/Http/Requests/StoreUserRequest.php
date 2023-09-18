<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
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
            "name" =>'required',
            "adresse" => 'required',
            //"telephone" => 'required|unique:users',
            "email" => 'required|email',
            "role"=>'required',
            "password"=>'required',
            //"password_confirme"=>'required|same:password',
            "succursale_id"=>'required',
            "login"=>'required',
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
            //'telephone.required'=>'Le numero telephone doit être fourni',
            'email.required'=>'L\'email doit être fourni',
            'role.required'=>'Le role doit être fourni',
            "succursale_id.required"=>'Le numero de succursale doit fourni',
            'login.required'=>'Le login doit être fourni',
        ];
    }
}
