<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index ()
    {
        $user = request()->user();

        return response()->json([
            'status_code'   => 200,
            'message'       => 'Berhasil mengambil data profile',
            'data'          => User::where('id', $user->id)->first()
        ]);
    }
}
