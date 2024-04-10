<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function nouveauMdp(Request $request)
    {
        if ($request->password === $request->repassword) {

            auth()->user()->MOTDEPASSE = bcrypt($request->password);
            auth()->user()->mdpAModifier = 0;

            auth()->user()->save();

            // Rediriger l'utilisateur vers la page dashboard
            return Redirect::to('/dashboard')->with('success', 'Votre mot de passe a été modifié avec succès.');
        }
        else{
            return Redirect::back()->with('error', 'Les mots de passe ne correspondent pas.');
        }
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Déconnecte l'utilisateur.
     *
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Vous avez été déconnecté avec succès.');
    }

    public function changeMdp()
    {
        return view('changeMdp');
    }
}
