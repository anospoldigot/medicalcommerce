<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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

    public function create ()
    {
        return view('admin.user.create');
    }


    public function edit (User $user)
    {
        return view('admin.user.create', compact('user'));
    }

    public function update (User $user)
    {
        return view('admin.user.create', compact('user'));
    }

    public function destroy (User $user)
    {

        try{
            $user->delete();
            session()->flash('success', 'Berhasil menghapus user');

            return redirect()->route('users.index');
        }catch(Exception $e){
            session()->flash('error', $e->getMessage());
            return back();
        }

    }


}
