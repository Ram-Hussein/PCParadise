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
    public function index(){
        return view('profile.user');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        if(Auth::user()->is_admin){
            $user = User::find($request->user_id);
            $request->validate([
            'fname' => ['alpha', 'max:255'],
            'lname' => ['alpha', 'max:255'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'dob' => ['date', 'before:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'country' => ['exists:countries,id'],
            'PhoneNumber' => ['numeric', ],
            ]);

            $user->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'date_of_birth' => $request->dob,
                'country_id' => $request->country,
                'PhoneNumber' => $request->PhoneNumber,
            ]);

            return redirect()->back();
        } else {
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

            return redirect()->back();
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
}
