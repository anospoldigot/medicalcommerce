<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index ()
    {

        $data = Product::get();
        
        return response()->json([
            'status_code'       => 200,
            'message'           => 'Berhasil mengambil data product',
            'data'              => $data
        ]);
    
    
    }
    public function popular ()
    {

        $data = Product::inRandomOrder()->get();

        return response()->json([
            'status_code'       => 200,
            'message'           => 'Berhasil mengambil data product',
            'data'              => $data
        ]);
    }

    public function forYou ()
    {

        $data = Product::inRandomOrder()->get();

        return response()->json([
            'status_code'       => 200,
            'message'           => 'Berhasil mengambil data product',
            'data'              => $data
        ]);
    }

    public function show ($id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json([
                'status_code'       => 200,
                'message'           => 'Berhasil mengambil data product',
                'data'              => $product
            ]);
        } catch (Exception $e) {
             return response()->json([
                'status_code'       => 404,
                'message'           => 'Data not found',
            ]);
        }
    }
}
