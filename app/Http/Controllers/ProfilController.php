<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\EmailVerificationCode;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function editProfil () {
        return view('profil', ['user' => Auth::user()]);
    }

    public function updateProfil (Request $request) {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user->updated($validated);

        return redirect()->route('profil.edit')->with('success', 'Informations mis à jour avec succès');
    }

    public function requestEmailChange (Request $request)
    {
        $user = Auth::user();

        if ($user->provider === 'Google') {
            return response()->json([
                'success' => false,
                'message' => 'Cette adresse est gérée par Google et ne peut etre modifiée!',
            ], 403);
        }

        $validated = $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        $verificationCode = (string) random_int(100000, 999999);

        $user->update([
            'pending_email' => $validated['email'],
            'email_verification_code' => $verificationCode,
            'email_verification_expires_at' => now()->addMinutes(5),
        ]);

        Notification::route('mail', $validated['email'])
            ->notify(new EmailVerificationCode($verificationCode));

        return response()->json([
            'success' => true,
            'message' => 'Un code de vérification à été envoyé à ta nouvelle adresse e-mail',
        ]);
    }

    public function verifyEmailChanges (Request $request)
    {
        $request->validate(['code' => ['required', 'digits:6']]);

        $user = Auth::user();

        if (!$user->pending_email || !$user->email_verification_code) {
            return response()->json([
                'success' => false,
                'message' => 'Aucune demande en cours',
            ], 400);
        }

        if ($user->email_verification_expires_at && now()->greaterThan($user->email_verification_expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Le code de vérification a expiré, veuillez réessayez!',
            ], 400);
        }

        if ($request->code !== $user->email_verification_code) {
            return response()->json([
                'success' => false,
                'message' => 'Code de vérification incorrect',
            ], 400);
        }

        $user->email = $user->pending_email;
        $user->pending_email = null;
        $user->email_verification_code = null;
        $user->email_verification_expires_at = null;
        $user->email_verified_at = now();
        $user->save();

        session()-flash('success', 'Adresse e-mail mise à jour avec succèss !');

        return response()->json([
            'success' => true,
            'message' => 'Adresse e-mail mise à jour avec succèss',
            'redirect' => route('profil.edit'),
        ]);

    }
}
