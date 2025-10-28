<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nombres" => "required",
            "apellidos" => "required",
            "nro_celular" => "required|unique:usuarios,nro_celular",
            "correo" => "required|email|unique:usuarios,correo", //agregar el campo "email_confirmation" en el POST si tiene el confirmed
            "contrasena" => "required|confirmed|min:8", //agregar el campo "contrasena_confirmation" en el POST si tiene el confirmed
            "estado" => "nullable|in:Ocupado,Desocupado",
        ];
    }

    public function messages(): array
    {
        return [
            'nombres.required' => 'El campo Nombres es obligatorio.',
            'apellidos.required' => 'El campo Apellidos es obligatorio.',
            'nro_celular.required' => 'El campo Nro. Celular es obligatorio.',
            'nro_celular.unique' => 'El Nro. Celular ya está registrado.',
            'correo.required' => 'El campo Correo es obligatorio.',
            'correo.email' => 'El Correo debe ser una dirección de correo válida.',
            'correo.unique' => 'El Correo ya está registrado.',
            'contrasena.required' => 'El campo Contraseña es obligatorio.',
            'contrasena.confirmed' => 'Las Contraseñas tienen que coincidir.',
            'contrasena.min' => 'La Contraseña debe tener al menos 8 caracteres.',
            'tipo_usuario.required' => 'El campo Tipo Usuario es obligatorio.',
            'tipo_usuario.in' => 'El campo Tipo Usuario debe ser uno de los valores: admin,chofer,marquetero',
            // 'contrasena.max' => 'La contraseña no puede tener más de 16 caracteres.',
        ];
    }

    public function encryptPassword()
    {
        $validatedData = parent::validated();
        $validatedData['contrasena'] = bcrypt($this->input('contrasena'));
        return $validatedData;
    }
}
