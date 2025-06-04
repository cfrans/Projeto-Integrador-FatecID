<?php

namespace App\Http\Requests;

use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

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
            'telefone' => ['required', 'string'],
            'endereco' => ['required', 'string', 'max:255'],
            'setor' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
        {
            $user = $request->user();
            $data = $request->validated();

            // Se tiver uma nova foto, armazena
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $path = $request->file('foto')->store('fotos_perfil', 'public');
                $data['foto'] = $path;
            }

            $user->fill($data);

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            return Redirect::route('profile.edit')->with('status', 'Perfil atualizado com sucesso!');
        }

      public function messages()
    {
        return [
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.regex' => 'Informe um telefone válido.',
            'endereco.required' => 'O endereço é obrigatório.',
            'endereco.string' => 'O endereço deve ser um texto válido.',
            'endereco.max' => 'O endereço deve ter no máximo 255 caracteres.',
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres.',
        ];
    }
}




  
