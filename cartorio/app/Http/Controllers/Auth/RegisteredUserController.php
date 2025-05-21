<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_API_KEY');
        $supabaseId = Str::uuid()->toString();

        $response = Http::withHeaders([
            'apikey' => $supabaseKey,
            'Authorization' => 'Bearer ' . $supabaseKey,
            'Content-Type' => 'application/json',
        ])->post("$supabaseUrl/rest/v1/user_profiles", [
            'id' => $supabaseId,            // usa o mesmo UUID do Laravel (ou gere um)
            'email' => $request->email,
            'nome' => $request->name,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
        ]);

        if ($response->failed()) {
            dd($response->body());
            return back()->withErrors('Erro ao criar perfil no Supabase.');
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
