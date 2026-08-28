<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function editProfil () {
        return view('profil.edit', ['user' => Auth::user()]);
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
