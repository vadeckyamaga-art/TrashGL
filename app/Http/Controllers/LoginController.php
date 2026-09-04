<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm () {
        return view('login');
    }

    public function login (Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withInput($request->only('email'))
                ->with('success', null)
                ->withErrors(['email' => 'Adresse email ou mot de passe incorrect!']);
        }

        $request->session()->regenerateToken();

        cookie()->queue('theme', Auth::user()->theme, 60 * 24 * 365 * 5);

        return redirect()->route('welcome')->with('success', 'Connexion réuissie, bienvenue sur TrashGL !');

    }

    public function rateLimiting (Request $request)
    {
        session()->forget(['rate_limit_expires_at', 'rate_limit_message']);
        return response()->json(['success' => true]);
    }

    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form')->with('success', 'Deconnexion réuissie, à très bientot sur TrashGL!');
    }
}
