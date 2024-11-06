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
        // print($request->occupation);
        // die();
         // Mengisi model pengguna dengan data yang valid
    $user = $request->user();
    $user->fill($request->validated());

    // Memeriksa apakah email diubah dan mengatur ulang status verifikasi email jika perlu
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // Memeriksa apakah ada file gambar yang diunggah
    if ($request->hasFile('avatar')) {
        // Menyimpan gambar baru
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath; // Menyimpan path gambar baru ke atribut model
    }

    // Menyimpan perubahan pada model pengguna
    $user->save();

    // Mengalihkan ke halaman edit profil dengan status update
    return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
}
