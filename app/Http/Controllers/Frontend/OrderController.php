<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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
        return view('frontend.order.show', compact('order'));
    }
}
