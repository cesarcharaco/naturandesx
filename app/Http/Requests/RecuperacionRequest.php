<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecuperacionRequest extends FormRequest
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
            'password' => 'required|string|min:8|confirmed'
        ];
    }

     public function mesagges(){
        return [
            'password.min' => 'La contraseña debe tener mínimo 8 dígitos',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'La confirmación de la contraseña no coincide'
        ]
     }
}
