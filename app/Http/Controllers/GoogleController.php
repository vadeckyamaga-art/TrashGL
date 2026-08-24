<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback () {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('provider', 'google')
            ->where('provider_id', $googleUser->getId())
            ->first();
        $isNewAccount = false;
        if (!$user) {
            $user = User::where('email', $googleUser->getId())->first();

            if ($user) {
                $user -> update ([
                    'provider' => 'Google',
                    'provider_id' => $googleUser->getId(),
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'provider' => 'Google',
                    'provider_id' => $googleUser->getId(),
                ]);
                $isNewAccount = true;
            }

        }
        Auth::login($user, remember: true);

        if ($isNewAccount) {
            return redirect()->route('register')->with('success', 'Compte créer avec succes, connexion en cours ...');
        }

        return redirect()->route('login')->with('success', 'Connexion réuissie, redirection en cours ...');
    }
}
