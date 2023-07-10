<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class WishlistController extends Controller
{
    
    public function index (){
        $user =  request()->user();

        $data = User::with('wishlists')->whereId($user->id)->first();

        if(!$data){
            return response()->json([
                'status_code'       => 404,
                'message'           => 'User not found',
            ], 200);
        }

        return response()->json([
            'status_code'       => 200,
            'message'           => 'Berhasil mengambil data wishlist',
            'data'              => $data->wishlists
        ], 200);

    }
}
