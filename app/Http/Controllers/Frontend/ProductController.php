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

        $products = Product::with(['assets', 'category'])
        ->latest()
            ->where('is_front', true)
            ->when(request()->has('category'), function ($query) {
                $query->where('id', request('category'));
            })
            ->when(request()->has('q'), function ($query) {
                $query->where('title', 'like', '%' . request('q') . '%');
            })
            ->when(request()->filled('min'), function ($query) {
                $query->where('price', '>=', request('min'));
            })
            ->when(request()->filled('max'), function ($query) {
                $query->where('price', '<=', request('max'));
            })
            ->get();

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
