<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function editProfil () {
        \Log::info('SHOW PROFIL FORM', [
            'session_id' => session()->getId(),
            'authenticated' => auth()->check(),
            'user_id' => auth()->id(),
        ]);
        return view('profil', ['user' => Auth::user()]);
    }

    public function updateProfil (Request $request) {
        $user = Auth::user();
        $isGoogleAccount = $user->provider === 'Google';

        $rules = ['name' => ['required', 'string', 'max:255'],];

        if (!$isGoogleAccount) {
            $rules['email'] = ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)];
        }

        $validated = $request->validate($rules);

        $user->update($validated);

        return redirect()->route('profil.edit')->with('success', 'Informations mis à jour avec succès');
    }
}
