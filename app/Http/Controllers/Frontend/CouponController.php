<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function check ()
    {

        $coupon = Coupon::firstWhere('code', request('code'));
        
        return response()->json([
            'success'   => true,
            'data'      => $coupon
        ]);
    }
}
