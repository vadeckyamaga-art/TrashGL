<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\EmailVerificationCode;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\BackgroundImage;
use Laravel\Socialite\Facades\Socialite;

class ProfilController extends Controller
{
    public function updateProfil (Request $request) {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user->update($validated);

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
            ->notify(new EmailVerificationCode($verificationCode, $user->name));

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

        if ( (string) $request->code !== (string) $user->email_verification_code) {
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

        session()->flash('success', 'Adresse e-mail mise à jour avec succèss !');

        return response()->json([
            'success' => true,
            'message' => 'Adresse e-mail mise à jour avec succèss',
            'redirect' => route('profil.edit'),
        ]);

    }

    public function cancelEmailChange(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'pending_email' => null,
            'email_verification_code' => null,
            'email_verification_expires_at' => null,
        ]);

        return response()->json(['success' => true]);
    }

    public function redirectEmailChange(string $provider)
    {
        session(['oauth_email_change_user_id' => Auth::id()]);
        return Socialite::driver($provider)->redirect();
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if ($user->provider !== null) {
            return redirect()->route('profil.edit')->with('error', 'Cette action n\'est pas disponible pour un compte connecté via ' . $user->provider . '.');
        }

        $validator = \Validator::make($request->all(), [
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('profil.edit')
                ->withErrors($validator, 'passwordUpdate');
        }

        $validated = $validator->validated();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->route('profil.edit')
                ->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.'], 'passwordUpdate');
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profil.edit')->with('success', 'Mot de passe mis à jour avec succès.');
    }

    public function updateLocale(Request $request)
    {
        $validated = $request->validate([
            'locale' => ['required', 'in:fr,en'],
        ]);

        Auth::user()->update(['language' => $validated['locale']]);

        return response()->json(['success' => true]);
    }

    public function updateTheme(Request $request)
    {
        $validated = $request->validate([
            'theme' => ['required', 'in:light,dark,system'],
        ]);

        Auth::user()->update(['theme' => $validated['theme']]);

        Cookie::queue('theme', $validated['theme'], 60 * 24 * 365 * 5); // 5 ans

        return response()->json(['success' => true]);
    }

    public function editProfil()
    {
        $user = Auth::user();
        $posts = $user->posts()->latest()->get();
        $backgroundImages = BackgroundImage::where('is_active', true)->get();

        return view('profil', compact('user', 'posts', 'backgroundImages'));
    }
}
