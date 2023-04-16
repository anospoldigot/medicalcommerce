<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if(request()->ajax()){
            $posts = [];
            if ($request->query('q') == 'listing') {
    
                $posts = Cache::rememberForever('listing_post', function () {
                    return Post::listing()->latest()->get();
                });
            } elseif ($request->query('q') == 'promote') {
    
                $posts = Cache::rememberForever('promote_post', function () {
                    return Post::promote()->latest()->get();
                });
            } else {
    
                $posts = Cache::rememberForever('all_post', function () {
                    return Post::latest()->get();
                });
            }

            return DataTables::of(Post::with('category')->latest())
                ->addIndexColumn()
                ->addColumn('action', 'admin.post._action')
                ->toJson();
        }

        return view('admin.post.index');

    }

    public function create ()
    {
        
        return view('admin.post.create', [
            'tags'          => Tag::all(),
            'categories'    => CategoryPost::all(),
        ]);
    }

    public function edit(Post $post)
    {   
        $tags = Tag::all();
        $categories = CategoryPost::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }
    
    public function getListing()
    {
        return response()->json([
            'success' => true,
            'results' => Post::listing()->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => ['required'],
            'image' => ['required'],
            'body' => ['required']
        ]);
        
        $path = public_path('/upload/images');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $post = new Post();

        $post->title            = $request->title;
        $post->slug             = Str::slug($request->title);
        $post->body             = $request->body;
        $post->category_id      = $request->category_id;
        $post->is_listing       = $request->boolean('is_listing');
        $post->is_promote       = $request->boolean('is_promote');
        if ($file = $request->file('image')) {

            $filename = Str::random(42) . '.' . $file->extension();

            if ($file->move($path, $filename)) {

                $post->image = $filename;
            }
        }

        try{
            $post->save();
            $post->tags()->attach($request->tags);
            return redirect()->route('post.index')->with('success', 'Berhasil menyimpan artikel');
            
        }catch(\Throwable $th){

            return redirect()->route('post.index')->with('error', $th->getMessage());
        }

    }


    public function storeAssets(Post $post)
    {
        $path = public_path('/upload/images');
        if ($file = request()->file('image')) {
            $filename = Str::random(42) . '.' . $file->extension();
            $file->move($path, $filename);
            return url('/') . '/upload/images/' . $filename;
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'success' => true,
            'results' => Post::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required'],
            'image' => $request->boolean('del_image') ? ['required'] : ['nullable'],
            'body' => ['required']
        ]);

        $path = public_path('/upload/images');

        $post = Post::findOrFail($id);

        if ($file = $request->file('image')) {

            $filename = Str::random(42) . '.' . $file->extension();

            if ($file->move($path, $filename)) {

                $post->image = $filename;
                File::delete('upload/images/' . $post->image);
            }
            
        }

        $post->title            = $request->title;
        $post->body             = $request->body;
        $post->category_id      = $request->category_id;
        $post->is_listing       = $request->boolean('is_listing');
        $post->is_promote       = $request->boolean('is_promote');

        $post->save();
        $post->tags()->attach($request->tags);
        return redirect()->route('post.index')->with('success', 'Berhasil mengupdate artikel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            File::delete('upload/images/' . $post->image);
        }

        $post->delete();

        return response([
            'success' => true
        ], 200);
    }
}
