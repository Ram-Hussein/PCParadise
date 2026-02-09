<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Carbon\Carbon;

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
    public function update(Request $request): RedirectResponse
    {
        /* $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated'); */
        $request->validate([
            'fname' => ['alpha', 'max:255'],
            'lname' => ['alpha', 'max:255'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'dob' => ['date', 'before:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'country' => ['exists:countries,id'],
            'PhoneNumber' => ['numeric', ],
        ]);

        Auth::user()->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'date_of_birth' => $request->dob,
            'country_id' => $request->country,
            'PhoneNumber' => $request->PhoneNumber,
        ]);

        dd($request->all());


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
