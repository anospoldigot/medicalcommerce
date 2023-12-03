<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $products = Product::where('title', 'like', '%' . request('keyword')  .'%')
            ->orWhere('description', 'like', '%' . request('keyword')  .'%')
            ->take(6)
            ->get();

        return response()->json([
            'status_code'   => 200,
            'message'       => 'Berhasil mengambil data pencarian',
            'data'          => $products
        ], 200);
    }
}
