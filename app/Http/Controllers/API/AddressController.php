<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index ()
    {
        $user = request()->user();

        $data = Address::where('user_id', $user->id)->get();

        return response()->json([
            'status_code'       => 200,
            'message'           => 'Berhasil mengambil data alamat',
            'data'              => $data
        ]);
    }
}
