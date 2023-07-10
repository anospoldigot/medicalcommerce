<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index ()
    {
        $user = request()->user();

        $carts = Cart::with('product.assets')->where('user_id', $user->id)->get();

        return response()->json([
            'status_code'       => 200,
            'message'           => 'Berhasil mengambil data cart',
            'data'              => $carts
        ]);
    }
}
