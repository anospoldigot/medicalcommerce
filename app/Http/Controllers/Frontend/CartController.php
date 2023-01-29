<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\District;
use App\Models\Product;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {

        $carts = Cart::with('product.assets', 'product.category')->where('user_id', auth()->id())->get();


        $order_subtotal = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->price;
        });

        $addresses = Address::where('user_id', auth()->id())->get();
        $provinces = Province::all();
        $regencies = Regency::all();
        $districts = District::all();
        $villages = Village::all();


        return view('frontend.cart.index', compact('carts', 'order_subtotal', 'addresses', 'provinces'));
    }

    public function store () 
    {
 
        request()->validate([
            // 'session_id' => 'required',
            // 'price' => 'required|numeric',
            // 'name' => 'required',
            // 'quantity' => 'required|numeric',
            // 'weight' => 'required|numeric',
            // 'sku' => 'required',
            // 'image_url' => 'required',
            // 'product_url' => 'required',
            // 'product_stock' => 'required',
        ]);

        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', request('product_id'))
                    ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {

            Cart::create([
                'user_id'               => auth()->id(),
                'product_id'            => request('product_id'),
                'product_history'       => Product::where('id', request('product_id'))->first(),
                'quantity'              => 1
            ]);
        }

        return response()->json([
            'success'       => true,
            'code'          => 200,
            'message'       => 'Berhasil menambah ke cart',
            'redirect_url'  => route('fe.carts.index')
        ], 200);
    }

}
