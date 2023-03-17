<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index ()
    {
        if (request()->ajax()) {
            return DataTables::of(User::latest()->get())
                ->addIndexColumn()
                ->addColumn('action', 'admin.user._action')
                ->toJson();
        }

        return view('admin.user.index');
    }

    public function show (User $user)
    {
        $user->load(['orders.transaction', 'orders.items', 'addresses']);

        return view('admin.user.show', compact('user'));
    }

    public function create ()
    {
        return view('admin.user.create');
    }

    public function store ()
    {
        $attr = request()->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed',
            'phone'     => 'nullable|numeric',
            'gender'    => 'nullable',
            'profile'   => 'nullable|image'
        ]);
        $attr = collect($attr)->filter(fn ($value) => !is_null($value));
        $attr['password'] = bcrypt(request('password'));
        $path = public_path('upload/images/');

        try {
            if ($attr->has('profile')) {
                $filename = Str::random(99) . '.webp';
                Image::make(request('profile')->getRealPath())
                    ->fit(500)
                    ->encode('webp', 90)
                    ->save($path . $filename);
                $attr['profile'] = $filename;
            }
            User::create($attr->all());
            session()->flash('success', 'Berhasil menambah data user');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('users.index');
    }


    public function edit (User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update (User $user)
    {
        $attr = request()->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|confirmed',
            'phone'     => 'nullable|numeric',
            'gender'    => 'nullable',
            'profile'   => 'nullable|image'
        ]);

        $attr = collect($attr)->filter(fn ($value) => !is_null($value));

        if (request()->filled('password')) {
            $attr['password'] = bcrypt(request('password'));
        }

        $path = public_path('upload/images/');
        try {
            if ($attr->has('profile')) {
                $filename = Str::random(99) . '.webp';
                Image::make(request('profile')->getRealPath())
                    ->fit(500)
                    ->encode('webp', 90)
                    ->save($path . $filename);
                $attr['profile'] = $filename;
            }
            $user->update($attr->all());
            session()->flash('success', 'Berhasil mengupdate data user');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('users.index');
    }

    public function destroy (User $user)
    {

        try{
            $user->delete();

            if($user->profile != 'avatar_default.webp'){
                File::delete(public_path('upload/images/' . $user->profile));
            }

            session()->flash('success', 'Berhasil menghapus user');

            return redirect()->route('users.index');
        }catch(Exception $e){
            session()->flash('error', $e->getMessage());
            return back();
        }

    }


}
