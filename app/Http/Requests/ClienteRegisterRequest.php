<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRegisterRequest extends FormRequest
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
            'usuario' => 'required|max:15|unique:users',
            'email' => 'max:255',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function mesagges()
    {
        return [
            'nombres.required' => 'El nombre es obligatorio',
            'nombres.max' => 'El nombre no puede contener mas de 255 caracteres',
            'apellidos.required' => 'El apellido es obligatorio',
            'apellidos.max' => 'El apellido no puede contener mas de 255 caracteres',
            'usuario.required' => 'El usuario es obligatorio',
            'usuario.max' => 'El usuario no debe contener mas de 15 caracteres',
            'usuario.unique' => 'Nombre de usuario ya registrado',
            'email.email' => 'El email debe ser válido',
            'email.max' => 'El email no debe contener mas de 255 caracteres',
            'rut.required' => 'El RUT es obligatorio',
            'rut.numeric' => 'El RUT solo debe contener números',
            'rut.max' => 'El RUT solo debe contener máximo 8 números'

        ];
    }
}
