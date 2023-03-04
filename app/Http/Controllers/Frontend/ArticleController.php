<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index ()
    {

        $articles = Post::get();
        $categories = CategoryPost::all();
        $tags = Tag::take(5)->get();

        return view('frontend.article.index', compact('articles','categories', 'tags'));
    } 


    public function show ($slug)
    {
        $post = Post::with('tags')->where('slug', $slug)->firstOrFail();
        request()->visitor()->visit($post);
        $articles = Post::take(4)->get();
        return view('frontend.article.show', compact('post', 'articles'));
    }
}
