<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $total_order = Order::count();
        $product = Product::count();
        $sales = OrderItem::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('quantity');
        $revenue = DB::table('order_items')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum(DB::raw('price * quantity'));

        $customer = User::whereHas('orders')->count();



        return view('admin.dashboard', compact('total_order', 'sales', 'customer', 'revenue', 'product'));
    }
}
