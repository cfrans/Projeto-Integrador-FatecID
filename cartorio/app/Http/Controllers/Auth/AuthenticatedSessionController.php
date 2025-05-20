<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */


    public function store(LoginRequest $request)
    {
        $email = $request->input('email');

        $supabaseUrl = env('SUPABASE_URL');
        $supabaseKey = env('SUPABASE_API_KEY');

        $response = Http::withHeaders([
            'apikey' => $supabaseKey,
            'Authorization' => 'Bearer ' . $supabaseKey,
        ])->get("$supabaseUrl/rest/v1/user_profiles", [
            'email' => 'eq.' . $email,
            'select' => '*'
        ]);

        $profiles = $response->json();

        if (empty($profiles)) {
            // Nenhum perfil encontrado no Supabase
            return back()->withErrors(['email' => 'Usuário não encontrado no Supabase']);
        }

        $userProfile = $profiles[0];

        // Aqui, para seguir com o login Laravel tradicional
        // (você pode verificar se o usuário existe no DB Laravel e autenticar)

        // Exemplo: usar o Auth normal
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
