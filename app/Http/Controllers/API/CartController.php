<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
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

    public function store ()
    {
        $user       = request()->user();
        $ref        = null;


        $cart = Cart::where('user_id', $user->id)
                    ->where('product_id', request('id'))
                    ->first();

        if ($cart) {
            // if(session()->has('ref')) $cart->update(['referral_id' => session()->get('ref')->ref]);
            $cart->increment('quantity');
        } else {
            $cart = Cart::create([
                'user_id'               => $user->id,
                'product_id'            => request('id'),
                'product_history'       => Product::where('id', request('id'))->first(),
                'quantity'              => 1,
                'referrer_id'           => $ref
            ]);
        }

        return response()->json([
            'status_code'           => 200,
            'message'               => 'Berhasil menambah ke cart',
        ], 200);
    }
}
