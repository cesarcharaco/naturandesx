<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesRequest extends FormRequest
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
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'email' => 'required|email|max:255|unique:clientes',
            'rut' => 'required|numeric|digits_between:7,8|unique:clientes'
        ];
    }

    public function mesagges()
    {
        return [
            'nombres.required' => 'El nombre es obligatorio',
            'nombres.max' => 'El nombre no puede contener mas de 255 caracteres',
            'apellidos.required' => 'El apellido es obligatorio',
            'apellidos.max' => 'El apellido no puede contener mas de 255 caracteres',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser válido',
            'email.max' => 'El email no debe contener mas de 255 caracteres',
            'email.unique' => 'Email ya registrado',
            'rut.required' => 'El RUT es obligatorio',
            'rut.numeric' => 'El RUT solo debe contener números',
            'rut.max' => 'El RUT solo debe contener máximo 8 números'

        ];
    }
}
