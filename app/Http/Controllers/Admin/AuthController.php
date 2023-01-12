<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class AuthController extends Controller
{
    public function login ()
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

            return redirect()->intended(route('dashboard'));
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    

}
