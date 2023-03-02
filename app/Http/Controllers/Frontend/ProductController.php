<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        if(request()->ajax()){

            $per_page = request('per_page') ?? 6;
            $page = request('page') ?? 1;
            $skip = ($page - 1) * $per_page;

            return Product::with(['assets', 'category'])
                ->latest()
                ->skip($skip)
                ->take($per_page)
                ->get();
        }

        $products = Product::with(['assets', 'category'])
            ->latest()
            ->paginate(6);

        $categories = Category::all();
        
        return view('frontend.product.index',  compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)->get();

        return view('frontend.product.show', compact('product', 'relatedProducts'));
    }
}
