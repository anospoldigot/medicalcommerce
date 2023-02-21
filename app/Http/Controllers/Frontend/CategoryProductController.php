<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index ($slug)
    {
        $category = Category::with('products')->where('slug', $slug)->firstOrFail();

        return view('frontend.category.index', compact('category'));
    }
}
