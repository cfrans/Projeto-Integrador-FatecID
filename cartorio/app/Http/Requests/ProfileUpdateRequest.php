<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'telefone' => ['required', 'regex:/^\+?\d{10,15}$/'],
            'endereco' => ['required', 'string', 'max:255'],
        ];
    }

      public function messages()
    {
        return [
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.regex' => 'Informe um telefone válido, com 10 a 15 dígitos, podendo começar com +.',
            'endereco.required' => 'O endereço é obrigatório.',
            'endereco.string' => 'O endereço deve ser um texto válido.',
            'endereco.max' => 'O endereço deve ter no máximo 255 caracteres.',
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome deve ter no máximo 255 caracteres.',
        ];
    }
}




  
