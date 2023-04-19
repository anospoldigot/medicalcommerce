<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Warehouse;
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
        $sales = OrderItem::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('quantity');
        $earning  = Transaction::where('type', 'in')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('amount');
            
        $expense  = Transaction::where('type', 'out')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('amount');

        $revenue = $earning - $expense;

        $callback = function ($q) {
            $q->whereMonth('created_at', date('m'));
            $q->whereYear('created_at', date('Y'));
        };
        $customer = User::whereHas('orders', $callback)->count();

        $warehouse  =  auth()->user()->warehouse;

        $callback = function ($q) {
            $q->withSum('selling', 'amount_after_disc');
        };


        $warehouses = Warehouse::with(['users' => $callback])->get();

        return view('admin.dashboard', compact(
            'total_order', 'sales', 'customer', 'revenue', 'product', 'warehouse', 'earning',
            'expense', 'warehouses'
        ));
    }
} 
