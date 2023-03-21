<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index ()
    {
        $where = [
            'user_id'   => auth()->id()
        ];

        $orders = Order::where($where)->get();

        return view('frontend.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $config = Config::first();
        $response = Http::withHeaders(['authorization' => $config->biteship_token])
            ->get('https://api.biteship.com/v1/trackings/' . $order->biteship_tracking_id);

        $response = json_decode($response);
        
        return view('frontend.order.show', compact('order', 'response'));
    }
}
