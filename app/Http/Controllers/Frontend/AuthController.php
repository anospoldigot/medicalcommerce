<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost()
    {
        $credentials = request()->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required'],
        ]);

        if (auth()->attempt($credentials)) {
            request()->session()->regenerate();

            if (auth()->user()->hasRole('customer')) {
                return redirect()->intended(route('landing'));
            }

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function myAccount()
    {
        return view('admin.setting.account', [
            'user' => auth()->user()
        ]);
    }

    public function update()
    {

        $rules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,' . auth()->id(),
            'phone'     => 'required|numeric',
            'password'  => 'nullable|confirmed|min:8'
        ];

        $attr = request()->validate($rules);

        if (request()->filled('password')) {
            $attr['password'] = bcrypt(request('password'));
        } else {
            unset($attr['password']);
        }

        try {
            User::where('id', auth()->id())->update($attr);
            session()->flash('success', 'Berhasil mengupdate');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
        }

        return redirect()->route('myAccount');
    }

    public function register()
    {

        return view('auth.register');
    }

    public function registerPost()
    {
        $data = request()->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'required|numeric',
            'password'  => 'required|min:8'
        ]);

        $data['role'] = 'user';
        $data['password'] = bcrypt(request('password'));
        $user = User::create($data);
        $user->assignRole('customer');
        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function verify()
    {
        event(new Registered(request()->user()));

        return view('auth.verify');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/');
    }

    public function resendVerify()
    {
        request()->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
