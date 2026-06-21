<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private const MAX_LOGIN_ATTEMPTS = 5;
    private const DECAY_MINUTES = 1;

    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }

        return view('public.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }

        return view('public.register');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:100'],
            'mot_de_passe' => ['required', 'string'],
        ], [
            'email.required' => 'Le champ email est obligatoire.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'mot_de_passe.required' => 'Le champ mot de passe est obligatoire.',
        ]);

        $key = 'login:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, self::MAX_LOGIN_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($key);

            return back()->withErrors([
                'email' => "Trop de tentatives de connexion. Veuillez réessayer dans {$seconds} secondes.",
            ])->onlyInput('email');
        }

        if (
            ! Auth::attempt([
                'email' => $request->email,
                'password' => $request->mot_de_passe,
            ], $request->filled('remember'))
        ) {
            RateLimiter::hit($key, self::DECAY_MINUTES * 60);

            Log::channel('auth')->warning('Tentative de connexion échouée', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            throw ValidationException::withMessages([
                'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
            ])->status(429);
        }

        RateLimiter::clear($key);

        $user = Auth::user();

        $request->session()->regenerate();
        $request->session()->put('auth_password_confirmed_at', time());

        Log::channel('auth')->info('Connexion réussie', [
            'user_id' => $user->id_utilisateur,
            'email' => $user->email,
            'role' => $user->role,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return $this->redirectByRole($user->role);
    }

    public function register(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }

        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:50', 'regex:/^[a-zA-ZÀ-ÖØ-öø-ÿ\s\-\']+$/'],
            'prenom' => ['required', 'string', 'max:50', 'regex:/^[a-zA-ZÀ-ÖØ-öø-ÿ\s\-\']+$/'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:utilisateurs,email'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'mot_de_passe' => ['required', 'string', 'min:4', 'confirmed'],
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom ne peut pas dépasser 50 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
                'mot_de_passe.required' => 'Le mot de passe est obligatoire.',
                'mot_de_passe.min' => 'Le mot de passe doit contenir au moins 4 caractères.',
            'mot_de_passe.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        $user = Utilisateur::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'] ?? null,
            'mot_de_passe' => Hash::make($validated['mot_de_passe']),
            'role' => 'conducteur',
        ]);

        Log::channel('auth')->info('Nouvel utilisateur enregistré', [
            'user_id' => $user->id_utilisateur,
            'email' => $user->email,
            'role' => $user->role,
        ]);

        return redirect()->route('login')->with('success', 'Compte créé avec succès. Connectez-vous.');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            Log::channel('auth')->info('Déconnexion', [
                'user_id' => $user->id_utilisateur,
                'email' => $user->email,
                'role' => $user->role,
                'ip' => $request->ip(),
            ]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Vous avez été déconnecté avec succès.');
    }

    private function redirectByRole(string $role): \Symfony\Component\HttpFoundation\Response
    {
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'gestionnaire' => redirect()->route('manager.dashboard'),
            'conducteur' => redirect()->route('driver.dashboard'),
            default => redirect()->route('home'),
        };
    }
}
