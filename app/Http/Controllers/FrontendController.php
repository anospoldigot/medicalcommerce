<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    
    public function index ()
    {

        $products = Product::with('assets', 'category')
            ->latest()
            ->where('is_front', true)
            ->get();

        $posts = Post::latest()->take(2)->get();

        return view('frontend.index',  compact('products', 'posts'));
    }

    

   
}
