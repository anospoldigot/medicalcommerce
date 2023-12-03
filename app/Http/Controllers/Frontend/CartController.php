<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Config;
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
    private $config;

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


        $this->config = Config::first();
    }

    public function index()
    {


        $ref = session()->get('ref')->ref ?? null;

        $config = $this->config;

        $ppn = $this->config->ppn;
        $paymentAmount = "10000"; //"YOUR_AMOUNT";
        $paymentMethodList = \Duitku\Api::getPaymentMethod($paymentAmount, $this->duitkuConfig);
        $paymentMethodList = json_decode($paymentMethodList);

        $carts = Cart::with('product.assets', 'product.category')->where('user_id', auth()->id())->get();
        $couriers = Http::withHeaders([
            'authorization' => $this->config->biteship_token
        ])
        ->get('https://api.biteship.com/v1/couriers');

        $couriers = collect(json_decode($couriers)->couriers)->groupBy('courier_name');

        $discount = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->discount_amount;
        });

        $order_subtotal = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->product->price;
        });

        $ppn_amount = $ppn ? (($order_subtotal - $discount) / 100) * $ppn : 0;
        $total_amount = $order_subtotal - $discount + $ppn_amount;

        $addresses = Address::with(['province', 'regency', 'village', 'district'])
            ->where('user_id', auth()->id())
            ->get();
        $provinces = Province::all();

        return view('frontend.cart.index', compact(
            'carts', 'order_subtotal', 'addresses', 'provinces', 'paymentMethodList', 'discount',
            'couriers', 'ppn', 'ppn_amount', 'ref', 'config', 'total_amount'
        ));
    }

    public function store () 
    {
 
        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', request('product_id'))
                    ->first();

        if ($cart) {
            if(session()->has('ref')) $cart->update(['referral_id' => session()->get('ref')->ref]);
            $cart->increment('quantity');
        } else {
             
            $cart = Cart::create([
                'user_id'               => auth()->id(),
                'product_id'            => request('product_id'),
                'product_history'       => Product::where('id', request('product_id'))->first(),
                'quantity'              => 1,
                'referrer_id'        => session()->has('ref') ? session()->get('ref')->ref : null
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

    public function destroy (Cart $cart)
    {
        
        $cart->delete();

        return response()->json([
            'success'       => true,
            'code'          => 200,
            'message'       => 'Berhasil menghapus cart',
        ], 200);
    }

}
