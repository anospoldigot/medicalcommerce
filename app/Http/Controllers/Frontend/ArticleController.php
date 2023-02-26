<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index ()
    {

        $articles = Post::paginate(6);
        $categories = CategoryPost::all();

        return view('frontend.article.index', compact('articles', 'categories'));
    }


    public function show ($slug)
    {
        $post = Post::with('tags')->where('slug', $slug)->firstOrFail();
        $articles = Post::take(4)->get();

        return view('frontend.article.show', compact('post', 'articles'));
    }
}
