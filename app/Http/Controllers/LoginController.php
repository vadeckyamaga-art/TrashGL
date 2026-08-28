<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm () {
        //dd(session()->all());
        \Log::info("session au chargement de /login", session()->all());

        \Log::info('SHOW LOGIN FORM', [
            'session_id' => session()->getId(),
            'authenticated' => auth()->check(),
            'user_id' => auth()->id(),
            'success_in_session' => session('success'),
        ]);

        return view('login');
    }

    public function login (Request $request)
    {
        \Log::info('SESSION ID AVANT ATTEMPT', [
            'id' => session()->getId(),
        ]);

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
        
        \Log::info('SESSION ID APRES ATTEMPT', [
            'id' => session()->getId(),
        ]);

        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Connexion réuissie, bienvenue sur TrashGL !');

    }

    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
