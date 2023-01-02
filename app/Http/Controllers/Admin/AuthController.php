<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login ()
    {
        return view('auth.login');
    }

    public function loginPost()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    

}
