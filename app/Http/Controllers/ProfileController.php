<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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
            'isOnlyAdmin' => User::count() <= 1,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if (!$user->isDirty()) {
            return Redirect::route('admin.profile.edit')->with('success', 'Nothing to update, your details are unchanged.');
        }

        $user->save();

        return Redirect::route('admin.profile.edit')->with('success', 'Profile details saved.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Deleting the last admin account would lock everyone out of the admin panel.
        if (User::count() <= 1) {
            return Redirect::route('admin.profile.edit')->with('error', 'You are the only admin, so this account cannot be deleted.');
        }

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ], [
            'password.current_password' => 'The password is incorrect.',
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
