<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function check ()
    {

        try {
            $coupon = Coupon::where('code', request('code'))->first();

            $message = [
                'success'   => true,
                'message'   => 'Coupon berhasil digunakan',
                'data'      => $coupon
            ];

            if (empty($coupon)) {
                $message = [
                    'success'   => false,
                    'message'   => 'Coupon tidak tersedia',
                ];
            }

            return response()->json($message);

        } catch (\Throwable $th) {

            return response()->json([
                'success'   => false,
                'message'   => 'Coupon Error'
            ]);
        }
    }
}
