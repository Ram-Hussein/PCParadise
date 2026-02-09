<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fname' => ['required', 'alpha', 'max:255'],
            'lname' => ['required', 'alpha', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'dob' => ['required', 'date', 'before:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'country' => ['required', 'exists:countries,id'],
            'PhoneNumber' => ['required', 'numeric', ],
        ]);

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country_id' => $request->country,
            'date_of_birth' => $request->dob,
            'is_admin' => 0,
            'PhoneNumber' => $request->PhoneNumber,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
