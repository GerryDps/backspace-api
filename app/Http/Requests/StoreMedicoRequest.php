<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreMedicoRequest extends FormRequest
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
            'email' => 'required|unique:App\Models\Paziente,email|email|max:255',
            'nome' => 'required|max:255',
            'cognome' => 'required|max:255',
            'datadinascita' => 'required|date',
            /* 'password' => ['required|max:255', Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()], */
            'password' => 'required|min:8|max:255', 
        ];
    }
}
