<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm () {
        //dd(session()->all());
        \Log::info("session au chargement de /login", session()->all());
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

        session()->flash('success', 'Connexion réuissie, redirection en cours ...');
        $request->session()->regenerate();

        return redirect()->route('login.form');
    }

    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
