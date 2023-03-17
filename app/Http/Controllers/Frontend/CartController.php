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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{


    private $duitkuConfig;
    private $merchantCode   = 'DS12776';
    private $merchantKey    = '14e82f3fd51b5518b435ee4970fc7534';
    private $callbackUrl    = 'https://medicalcommerce.test/callback';
    private $returnUrl      = 'https://medicalcommerce.test/callback';
    private $authorization = 'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiUGVtZWRpayIsInVzZXJJZCI6IjYzZDMwMzMyOWFiOTQ1MTIyYjY3NWE0NyIsImlhdCI6MTY3NDc3MzQ0M30.IAjCyQMVlIzLWFkKnKbDKFc8AFVwVLYFkeFy-ncT_eg';
    
    public function __construct()
    {
        $this->duitkuConfig = new \Duitku\Config($this->merchantKey, $this->merchantCode);
        // false for production mode
        // true for sandbox mode
        $this->duitkuConfig->setSandboxMode(true);
        // set sanitizer (default : true)
        $this->duitkuConfig->setSanitizedMode(false);
        // set log parameter (default : true)
        $this->duitkuConfig->setDuitkuLogs(true);
    }

    public function index()
    {

        $paymentAmount = "10000"; //"YOUR_AMOUNT";
        $paymentMethodList = \Duitku\Api::getPaymentMethod($paymentAmount, $this->duitkuConfig);
        $paymentMethodList = json_decode($paymentMethodList);

        $carts = Cart::with('product.assets', 'product.category')->where('user_id', auth()->id())->get();
        $couriers = Http::withHeaders([
            'authorization' => $this->authorization
        ])
        ->get('https://api.biteship.com/v1/couriers');

        $couriers = collect(json_decode($couriers)->couriers)->groupBy('courier_name');


        $discount = $carts->sum(function ($cart) {
            $price = 0;
            
            if($cart->product->is_discount > 0){
                $price = $cart->product->price;
                if($cart->product->discount_type == 'persen'){
                    $price = ($cart->product->price / 100) * $cart->product->discount;
                }else if($cart->product->discount_type == 'nominal'){
                    $price = $cart->product->price - $cart->product->discount;
                }

                $price = $cart->product->price - $price;
            }

            return $cart->quantity * $price;
        });

        $order_subtotal = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->price;
        });


        $addresses = Address::with(['province', 'regency', 'village', 'district'])->where('user_id', auth()->id())->get();
        $provinces = Province::all();

        return view('frontend.cart.index', compact(
            'carts', 'order_subtotal', 'addresses', 'provinces', 'paymentMethodList', 'discount',
            'couriers'
        ));
    }

    public function store () 
    {
 
        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', request('product_id'))
                    ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            $cart = Cart::create([
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
            'redirect_url'  => route('fe.carts.index'),
            'data'          => $cart->load('product.assets')
        ], 200);
    }

    public function count ()
    {
        $count = DB::table('carts')->where('user_id', auth()->id())->count();

        return response()->json([
            'success'       => true,
            'code'          => 200,
            'message'       => 'Berhasil mengambil total cart',
            'data'          => $count
        ], 200);
    }

}
