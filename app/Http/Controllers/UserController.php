<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required|regex:^[a-zA-Z]+( [a-zA-Z]+)+$',
                'email' => 'required|email',
                'password' => 'required|string|confirmed|min:8',
                'PhoneNumber' => 'required|numeric',
                'gender' => 'required|alpha'
            ]);
            $user = User::create([
                'Fname' => $request->Fname,
                'Mname' => $request->Mname,
                'Lname' => $request->Lname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'PhoneNumber' => $request->PhoneNumber ,
                'gender' => $request->gender,
                'is_admin' => 0,
                'privacy_accepted' => 1
            ]);
            return redirect('users');

    }
    
}
