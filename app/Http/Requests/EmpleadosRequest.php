<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadosRequest extends FormRequest
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
            'telefono' => 'required|max:12',
            'usuario' => 'required|max:15|unique:users',
            'email' => 'required|email|max:255|unique:users'
        ];
    }

    public function mesagges()
    {
        return [
            'nombres.required' => 'El nombre es obligatorio',
            'nombres.max' => 'El nombre no puede contener mas de 255 caracteres',
            'apellidos.required' => 'El apellido es obligatorio',
            'apellidos.max' => 'El apellido no puede contener mas de 255 caracteres',
            'telefono.required' => 'El telefono es obligatorio',
            'telefono.max' => 'El telefono no debe contener mas de 12 caracteres',
            'rut.required' => 'El RUT es obligatorio',
            'rut.numeric' => 'El RUT solo debe contener números',
            'rut.max' => 'El RUT solo debe contener máximo 8 números',
            'usuario.required' => 'El usuario es obligatorio',
            'usuario.max' => 'El usuario no debe contener mas de 255 caracteres',
            'usuario.unique' => 'Usuario ya registrado',
            'email.email' => 'El email debe ser válido',
            'email.max' => 'El email no debe contener mas de 255 caracteres',
            'email.unique' => 'Email ya registrado',
            'email.required' => 'El email es obligatorio',

        ];
    }
}
