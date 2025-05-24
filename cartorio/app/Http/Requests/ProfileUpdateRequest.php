<?php

namespace App\Http\Requests;

use App\Models\Usuario;
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
            'nome' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(Usuario::class)->ignore($this->user()->id),
            ],
            'telefone' => ['required', 'regex:/^\+?\d{10,15}$/'],
            'endereco' => ['required', 'string', 'max:255'],
            'setor' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];
    }

    public function update(ProfileUpdateRequest $request)
        {
            $user = $request->user();

            // Atualiza campos básicos
            $user->nome = $request->nome;
            $user->email = $request->email;
            $user->telefone = $request->telefone;
            $user->endereco = $request->endereco;
            $user->setor = $request->setor;

            // Trata o upload da foto, se houver
            if ($request->hasFile('foto')) {
                // opcional: deletar foto antiga, se desejar

                $path = $request->file('foto')->store('fotos', 'public');
                $user->foto = $path;
            }

            $user->save();

            return back()->with('status', 'profile-updated');
        }

      public function messages()
    {
        return [
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.regex' => 'Informe um telefone válido, com 10 a 15 dígitos, podendo começar com +.',
            'endereco.required' => 'O endereço é obrigatório.',
            'endereco.string' => 'O endereço deve ser um texto válido.',
            'endereco.max' => 'O endereço deve ter no máximo 255 caracteres.',
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres.',
        ];
    }
}




  
