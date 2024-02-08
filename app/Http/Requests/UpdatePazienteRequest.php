<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePazienteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'nome' => 'required|max:255',
            'cognome' => 'required|max:255',
            'datadinascita' => 'required|date',
            'tipo' => 'required|max:255',
            'medico_id' => 'integer|exists:App\Models\Medico,id',
        ];
    }
}
