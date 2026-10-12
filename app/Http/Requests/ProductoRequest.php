<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'nombre' => 'required|string|max:100',
            'description' => 'nullable|string',
            'precio' => 'required|numeric|decimal:2',
            'stock' => 'required|integer|min:0',
            'activo' => 'required|boolean',
            'marca_id' => 'required|exists:marcas,id',
        ];
    }

    public function messages(): array
    {
        return [
            'precio.required' => 'El campo precio es obligatorio.',
            'precio.numeric'  => 'El precio debe ser un valor numérico.',
            'precio.regex'    => 'El precio debe tener un formato válido con hasta dos decimales (ej. 15.50).',
        ];
    }
}
