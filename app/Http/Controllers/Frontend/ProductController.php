<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Config;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

        $sliders = Slider::get();

        $products = Product::with(['assets', 'category'])
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::all();
        
        return view('frontend.product.index',  compact('products', 'categories', 'sliders'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        if(request()->has('ref')){
            $config = Config::first();
            $product->ref = request()->query('ref');
            session()->put('ref', $product, Carbon::now()->addHours($config->session_ref));
        }


        $relatedProducts = Product::where('category_id', $product->category_id)->get();

        return view('frontend.product.show', compact('product', 'relatedProducts'));
    }

    public function review (Product $product)
    {
        return view('frontend.product.review', compact('product'));
    }
}
