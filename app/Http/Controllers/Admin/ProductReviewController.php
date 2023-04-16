<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductReviewController extends Controller
{
    public function index (Product $product)
    {
        
        if(request()->ajax()){
            return DataTables::of(Review::where('product_id', $product->id))
                ->addIndexColumn()
                ->addColumn('action', function($model) use ($product){
                    return view('admin.product.review._action', compact('model', 'product'));
                })
                ->toJson();
        }

        return view('admin.product.review.index', compact('product'));
    }


    public function destroy(Product $product, Review $review)
    {

        try{
            $review->delete();
            session()->flash('success', 'Berhasil menghapus review');
        }catch(Exception $e){
            session()->flash('error', 'Gagal menghapus review');
        }

        return redirect()->route('products.reviews.index', $product->id);
    }
}
