<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CambiarPasswordRequest extends FormRequest
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
            "Correo" => "required|email|exists:usuarios,correo",
            "Contrasena" => "required|string|confirmed",
        ];
    }

    public function messages(): array
    {
        return [
            "Correo.required" => "El correo electrónico es obligatorio.",
            "Correo.email" => "El formato del correo electrónico no es válido.",
            "Correo.exists" => "El correo electrónico no está registrado en el sistema.",
            "Contrasena.required" => "La nueva contraseña es obligatoria.",
            "Contrasena.string" => "La contraseña debe ser una cadena de caracteres.",
            // "password.min" => "La contraseña debe tener al menos 8 caracteres.",
            "Contrasena.confirmed" => "La confirmación de la contraseña no coincide.",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Errores de validación.',
                'errors' => $validator->errors()->messages(),
            ], 422)
        );
    }
}
