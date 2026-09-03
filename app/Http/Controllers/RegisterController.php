<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\EmailVerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function Register(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $verificationCode = (string) random_int(100000, 999999);

        Cache::put('pending_registration_' . $validate['email'], [
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
            'code' => $verificationCode,
        ], now()->addMinutes(5));

        Notification::route('mail', $validate['email'])
            ->notify(new EmailVerificationCode($verificationCode, $validate['name']));

        $request->session()->put('verification_email', $validate['email']);

        return response()->json([
            'success' => true,
            'message' => 'Un code de vérification a été envoyé à votre adresse e-mail'
        ]);
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6']
        ]);

        $email = $request->session()->get('verification_email');
        $pending = $email ? Cache::get('pending_registration_' . $email) : null;

        if (!$pending) {
            return response()->json([
                'success' => false,
                'message' => 'Aucune inscription en attente ou le code a expiré, veuillez réessayer.'
            ], 400);
        }

        if ((string) $request->code !== (string) $pending['code']) {
            return response()->json([
                'success' => false,
                'message' => 'Code de vérification incorrect!'
            ], 400);
        }

        // Sécurité : quelqu'un d'autre a pu prendre cet e-mail entre-temps
        if (User::where('email', $pending['email'])->exists()) {
            Cache::forget('pending_registration_' . $email);
            $request->session()->forget('verification_email');

            return response()->json([
                'success' => false,
                'message' => 'Cette adresse e-mail vient d\'être utilisée par un autre compte.'
            ], 409);
        }

        $user = User::create([
            'name' => $pending['name'],
            'email' => $pending['email'],
            'password' => $pending['password'],
            'email_verified_at' => now(),
        ]);

        Cache::forget('pending_registration_' . $email);

        Auth::login($user);

        cookie()->queue('theme', $user->theme, 60 * 24 * 365 * 5);

        $request->session()->forget('verification_email');
        $request->session()->regenerate();

        session()->flash('success', 'Inscription réussie, veuillez vous connectez!');

        return response()->json([
            'success' => true,
            'message' => 'Adresse e-mail vérifiée avec succès, veuillez vous connecter!',
            'redirect' => route('login.form')
        ]);
    }

    public function cancelRegistration(Request $request)
    {
        $email = $request->session()->get('verification_email');

        if ($email) {
            Cache::forget('pending_registration_' . $email);
        }

        $request->session()->forget('verification_email');

        return response()->json(['success' => true]);
    }
}
