<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback ()
    {
        
        Order::where('order_ref', request('referenceNo'))->update([
            'raw_callback' => json_encode(request()->all())
        ]);

        return redirect()->route('fe.payment.show', request('referenceNo'));
    }

    public function show ($trx_id)
    {
        $transaksi = Order::where('order_ref', $trx_id)->first();

        return view('frontend.payment.show', compact('transaksi'));
    }
}
