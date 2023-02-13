<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    public function index ()
    {

        if(request()->ajax()){
            return DataTables::of(Coupon::withCount('orders')->get())
                ->addIndexColumn()
                ->toJson();
        }
        
        return view('admin.coupon.index');
    }
}
