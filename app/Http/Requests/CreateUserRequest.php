<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'email' => ['required', 'email'],
            'name' => ['required'],
            'cpf' => ['required'],
            'password' => ['required', 'min:7']
        ];
    }

    public function messages(): array {
        return [
            'email.required' => 'Email é um campo obrigatório.',
            'email.email' => 'Email deve ser um endereço válido.',
            'name.required' => "Nome é um campo obrigatório",
            'cpf.required' => "CPF é um campo obrigatório",
            'password.required' => "Senha é um campo obrigatório",
            'password.min' => "Senha precisa conter no mínimo 7 caracteres",
        ];
    }
}
