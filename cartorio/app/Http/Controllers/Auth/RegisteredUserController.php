<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        return view('auth.register', ['email' => $request->query('email')]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        try {

            Log::info('Teste de log - Chegou no controller');

            $request->validate([
                'nome' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Usuario::class],
                'telefone' => ['required', 'string'],
                'endereco' => ['required', 'string', 'max:255'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'setor' => ['required', 'string', 'max:255'],
                'usuario' => ['required', 'string', 'max:255', 'unique:' . Usuario::class],
                // 'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
            ]);

            Log::info('Validacao OK: ' . $request->email);

            $user = Usuario::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telefone' => $request->telefone,
                'endereco' => $request->endereco,
                'setor' => $request->setor,
                'usuario' => $request->usuario,
                // 'foto' => $request->foto
            ]);

            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        } catch (ValidationException $e) {
            // Erros de validação explícitos (como "usuario já está em uso")
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            // Outros erros inesperados
            Log::error('Erro ao registrar usuário: ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'error' => 'Erro ao registrar usuário. Por favor, tente novamente.'
            ]);
        }
    }
}
