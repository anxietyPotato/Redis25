<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\ChangeAvatarRequest;

use Illuminate\Support\Facades\Storage;



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








    public function changeAvatar(ChangeAvatarRequest $request) : RedirectResponse
    {
        $user = auth()->user();


            //delete old avatar if exists
            $avatar = Auth::user()->avatar;
        if ($user->avatar) {
            Storage::disk('public')->delete('images/avatars/' . $user->avatar);
        }




            $path = $request->file('avatar')->store('images/avatars', 'public');
            $filename = basename($path);


        $user->update(['avatar' => $filename]);

                return redirect()->route('profile.edit')->with('status', 'Avatar updated successfully!');
    }

}
