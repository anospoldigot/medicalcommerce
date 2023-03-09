<?php

namespace App\Http\Controllers\Admin;

use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login ()
    {
        return view('admin.auth.login');
    }

    public function loginPost()
    {
        $credentials = request()->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required'],
        ]);

        if (!NoCaptcha::verifyResponse(request('g-recaptcha-response'))) {
            return back()->withErrors([
                'email' => 'captcha error.',
            ])->onlyInput('email');
        } 

        $user = User::where('email', request('email'))->first();
        if (Hash::check(request('password'), $user->password)) {
            
            if($user->hasRole(['admin', 'developer'])){
                Auth::login($user);
                request()->session()->regenerate();
                return redirect()->intended(route('dashboard'));
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
        
        if(request()->filled('password')){
            $attr['password'] = bcrypt(request('password'));
        }else{
            unset($attr['password']);
        }

        try{
            User::where('id', auth()->id())->update($attr);
            session()->flash('success', 'Berhasil mengupdate');
        }catch(\Throwable $th){
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
