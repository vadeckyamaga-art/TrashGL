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

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            $wasEmailChange = session()->has('oauth_email_change_user_id');
            session()->forget('oauth_email_change_user_id');

            if ($wasEmailChange) {
                return redirect()->route('profil.edit')->with('error', 'La connexion à Google a été annulée ou a échoué.');
            }

            return redirect()->route('login.form')->with('error', 'La connexion avec Google a été annulée ou a échoué.');
        }

        // Cas : changement d'adresse e-mail initié depuis le profil
        if ($userId = session('oauth_email_change_user_id')) {
            session()->forget('oauth_email_change_user_id');

            $user = User::findOrFail($userId);

            $emailTaken = User::where('email', $googleUser->getEmail())
                ->where('id', '!=', $user->id)
                ->exists();

            if ($emailTaken) {
                return redirect()->route('profil.edit')->with('error', 'Cette adresse est déjà utilisée par un autre compte.');
            }

            $user->update([
                'email' => $googleUser->getEmail(),
                'provider' => 'Google',
                'provider_id' => $googleUser->getId(),
                'email_verified_at' => now(),
            ]);

            Auth::login($user, remember: true);

            cookie()->queue('theme', $user->theme, 60 * 24 * 365 * 5);

            return redirect()->route('profil.edit')->with('success', 'Adresse e-mail mise à jour avec succès.');
        }

        // Cas normal : connexion / inscription via Google
        $user = User::where('provider', 'Google')
            ->where('provider_id', $googleUser->getId())
            ->first();

        $isNewAccount = false;

        if (!$user) {
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'provider' => 'Google',
                    'provider_id' => $googleUser->getId(),
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'provider' => 'Google',
                    'provider_id' => $googleUser->getId(),
                    'avatar_id' => User::randomAvatarId(),
                ]);
                $isNewAccount = true;
            }
        }

        Auth::login($user, remember: true);

        cookie()->queue('theme', $user->theme, 60 * 24 * 365 * 5);

        if ($isNewAccount) {
            return redirect()->route('login.form')->with('success', 'Compte créer avec succes, veuillez vous connectez ...');
        }

        return redirect()->route('welcome')->with('success', 'Connexion réuissie, bienvenue sur TrashGL ...');
    }
}
