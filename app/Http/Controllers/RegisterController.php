<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\EmailVerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showRegisterForm(){
        return view('register');
    }

    public function Register(Request $request)
    {
        $existingUnverified = User::where('email', $request->input('email'))
            ->whereNull('email_verified_at')
            ->whereNull('provider')
            ->first();

        if ($existingUnverified) {
            $verificationCode = (string) random_int(100000, 999999);

            $existingUnverified->update([
                'name' => $request->input('name'),
                'email_verification_code' => $verificationCode,
                'email_verification_expires_at' => now()->addMinutes(5),
            ]);

            $existingUnverified->notify(new EmailVerificationCode($verificationCode, $existingUnverified->name));

            $request->session()->put('verification_email', $existingUnverified->email);

            return response()->json([
                'success' => true,
                'message' => 'Un nouveau code de vérification a été envoyé à votre adresse e-mail',
            ]);
        }

        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $verificationCode = (string) random_int(100000, 999999);

        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => $validate['password'],
            'email_verification_code' => $verificationCode,
            'email_verification_expires_at' => now()->addMinutes(5),
        ]);

        $user->notify(new EmailVerificationCode($verificationCode, $user->name));

        $request->session()->put('verification_email', $user->email);

        return response()->json([
            'success' => true,
            'message' => 'Un code de vérification a été envoyé à votre adresse e-mail'
        ]);
    }

    public function verifyEmail(Request $request)
    {
        $request -> validate([
            'code' => ['required', 'digits:6']
        ]);

        $email = $request->session()->get('verification_email');

        $user = User::where ('email', $email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur introuvable!'
            ], 400);
        }

        if (!$user -> email_verification_code) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun code de vérification!'
            ], 400);
        }

        if (
            $user -> email_verification_expires_at &&
            now()->greaterThan($user -> email_verification_expires_at)
            ) {
            return response()->json([
                'success' => false,
                'message' => 'Le code de vérification a expiré!'
            ], 400);
        }

        if ( (string) $request ->code !== (string) $user->email_verification_code) {
            return response()->json([
                'success' => false,
                'message' => 'Code de vérification incorrect!'
            ], 400);
        }

        $user -> email_verified_at = now();
        $user -> email_verification_code = null;
        $user -> email_verification_expires_at = null;

        $user -> save();

        Auth::login($user);

        $request->session()->forget('verification_email');
        $request->session()->regenerate();

        session()->flash('success', 'Inscription réussie, veuillez vous connectez!');

        return response()->json([
            'success' => true,
            'message' => 'Adresse e-mail vérifiée avec success, veuillez vous connecter!',
            'redirect' => route('login.form')
        ]);
    }

    public function cancelRegistration(Request $request)
    {
        $email = $request->session()->get('verification_email');

        if ($email) {
            $user = User::where('email', $email)->whereNull('email_verified_at')->first();

            if ($user) {
                $user->delete();
            }
        }

        $request->session()->forget('verification_email');

        return response()->json(['success' => true]);
    }
}
