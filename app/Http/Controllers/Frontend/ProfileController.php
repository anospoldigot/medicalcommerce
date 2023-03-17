<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    public function index ()
    {
        $user = auth()->user();

        return view('frontend.profile.index', compact('user'));
    }

    public function update ()
    {
        $id = auth()->id();
        $attr = request()->validate([
            'name'      => 'nullable',
            'email'     => 'nullable|email|unique:users,email,' . $id,
            'password'  => 'nullable|confirmed',
            'phone'     => 'nullable|numeric',
            'gender'    => 'nullable',
            'profile'   => 'nullable|image'
        ]);

        $attr = collect($attr)->filter(fn ($value) => !is_null($value));

        if(request()->filled('password')){
            $attr['password'] = bcrypt(request('password'));
        }

        $path = public_path('upload/images/');
        try{
            if(request()->has('profile')){
                $filename = Str::random(99) . '.webp';
                Image::make(request('profile')->getRealPath())
                    ->fit(500)
                    ->encode('webp', 90)
                    ->save($path . $filename);
                $attr['profile'] = $filename;
            }
            User::whereId($id)->update($attr);
            session()->flash('success', 'Berhasil mengupdate data profile');
        }catch(\Throwable $th){
            session()->flash('error', $th->getMessage());
        }

        return back();
    }
}
