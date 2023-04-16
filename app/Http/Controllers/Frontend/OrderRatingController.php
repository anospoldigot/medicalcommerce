<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderRatingController extends Controller
{
    public function store(Order $order)
    {
        $user = auth()->user();

        $validator = Validator::make(request()->all(), [
            'product_id'        => 'required',
            'comment'           => 'required',
            'rating'            => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => $validator->errors()->first()
            ]);
        }

        $review                 = $validator->valid();
        $review['order_id']     = $order->id;
        $review['user_id']      = $user->id;
        $review['name']         = $user->name;

        try{
            Review::create($review);
            
            return response()->json([
                'success'   => true,
                'message'   => 'Berhasil memberi review'
            ]);           

        }catch(Exception $e){

            return response()->json([
                'success'   => false,
                'message'   => 'Gagal memberi review'
            ]);
        }


    }
}
