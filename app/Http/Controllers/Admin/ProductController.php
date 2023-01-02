<?php

namespace App\Http\Controllers\Admin;

use App\Models\Asset;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(request()->ajax()){
            $products = Cache::rememberForever('products', function () {
                return Product::with('assets', 'category')->latest()->get();
            });

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('action', 'admin.product._action')
                ->toJson();
        }
        
        return view('admin.product.index');
    }

    public function create()
    {
        return view('admin.product.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Display a listing of the product favorites.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductsFavorites(Request $request)
    {
        return response([
            'success' => true,
            'results' => [
                'products' => Product::with('assets', 'category')->whereIn('id', $request->pids)->get()
            ]
        ], 200);
    }
    public function getProductsByCategory($id)
    {
        return response([
            'success' => true,
            'results' => [
                'products' => Product::with('assets', 'category')->where('category_id', $id)->get(),
                'category' => Category::find($id)
            ]
        ], 200);
    }
    /**
     * Display a listing of the search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $products = [];
        if ($request->q) {
            $key = trim($request->q);
            $key = strip_tags($key);
            $key = filter_var($key, FILTER_SANITIZE_STRING);

            $products = Product::with('assets', 'category')
                ->where('title', 'like', '%' . $key . '%')
                ->orWhere('description', 'like', '%' . $key . '%')
                ->get();
        }
        return response([
            'success' => true,
            'results' => [
                'products' => $products
            ]

        ], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($slug)
    // {
    //     return response([
    //         'success' => true,
    //         'results' => Product::with('assets', 'category', 'reviews', 'variants.variant_items.variant_item_values')->withCount('reviews')->where('slug', $slug)->first()
    //     ], 200);
    // }
    public function show($id)
    {
        $product = Product::with('assets', 'category', 'reviews', 'variants.variant_items.variant_item_values')
            ->withCount('reviews')
            ->where('id', $id)
            ->first();
        
        return view('admin.product.show', compact('product'));
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
            'title' => 'required|unique:products',
            'price' => 'required',
            'weight' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            'images' => 'required'
        ], [
            'title.unique' => 'Nama produk sudah digunakan'
        ]);

        $path = public_path('/upload/images');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        DB::beginTransaction();

        try {
            $slug = Str::slug($request->title);
            $product = new Product();

            $product->title = $request->title;
            $product->slug = $slug;
            $product->price = str_replace(",", "", $request->price);
            $product->stock = $request->stock;
            $product->weight = $request->weight;

            $product->category_id =  $request->category_id;

            $product->description = $request->description;

            $product->sku = 'PRD' . Str::random(14);

            $product->save();

            if ($request->images) {
                foreach ($request->images as $file) {

                    $filename = Str::random(41) . '.' . $file->extension();

                    $file->move($path, $filename);

                    $product->assets()->create([
                        'filename' => $filename
                    ]);
                }
            }


            if ($request->variants) {

                $product->refresh();

                $variants = json_decode($request->variants, true);

                foreach ($variants as $var) {

                    if (count($var['variant_items']) > 0) {

                        $variant = $product->variants()->create([
                            'variant_name' => $var['variant_name'],
                            'variant_item_name' => $var['variant_item_name']
                        ]);

                        foreach ($var['variant_items'] as $varItem) {

                            if (count($varItem['variant_item_values']) > 0) {

                                $item = $variant->variant_items()->create([
                                    'variant_item_label' => $varItem['variant_item_label']
                                ]);

                                foreach ($varItem['variant_item_values'] as $value) {

                                    $value['product_id'] = $product->id;
                                    $item->variant_item_values()->create($value);
                                }
                            }
                        }
                    }
                }
            }


            DB::commit();

            Cache::forget('products');
            Cache::forget('initial_products');

            return redirect()->route('product.index')->with('success', 'Berhasil membuat data product');
        } catch (\Throwable $th) {
            
            DB::rollBack();
            
            return redirect()->route('product.index')->with('error', 'Gagal membuat data product');
            // return response([
            //     'success' => false,
            //     'message' => $th->getMessage(),
            //     'results' => null

            // ], 500);
        }
    }



    public function edit ($id)
    {
        $product = Product::with('assets', 'category', 'reviews', 'variants.variant_items.variant_item_values')
        ->withCount('reviews')
            ->where('id', $id)
            ->firstOrFail();

        $categories = Category::all();

        return view('admin.product.edit', compact('product', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd(request()->all());
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'weight' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            // 'images' => 'mimes:png,jpg,svg'
        ]);

        $path = public_path('/upload/images');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        DB::beginTransaction();

        $product->title = $request->title;
        $product->price = str_replace(",", "", $request->price);
        $product->stock = $request->stock;
        $product->weight = $request->weight;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        try {

            if(request()->has('oldImageProduct')){
                if(count($request->oldImageProduct) != count($product->assets)){
                    foreach($product->assets as $filename){
                        if(!collect($request->oldImageProduct)->contains('filename', $filename)){
                            File::delete('upload/images/' . $filename);
                            Asset::where('filename', $filename)->delete();
                        };
                    }
                }
            }else{
                foreach ($product->assets as $filename) {
                        File::delete('upload/images/' . $filename);
                }
                $product->assets()->delete();
            }

            if ($request->images) {
                foreach ($request->images as $file) {

                    $filename = Str::random(42) . '.' . $file->extension();
                    $file->move($path, $filename);
                    $product->assets()->create([
                        'filename' => $filename
                    ]);
                }
            }
            // if ($request->del_images) {
            //     foreach ($request->del_images as $filename) {
            //         File::delete('upload/images/' . $filename);
            //         Asset::where('filename', $filename)->delete();
            //     }
            // }

            $product->save();

            if ($request->variants) {

                $product->variants()->delete();

                $variants = json_decode($request->variants, true);

                foreach ($variants as $var) {

                    if (count($var['variant_items']) > 0) {

                        $variant = $product->variants()->create([
                            'variant_name' => $var['variant_name'],
                            'variant_item_name' => $var['variant_item_name']
                        ]);

                        foreach ($var['variant_items'] as $varItem) {

                            if (count($varItem['variant_item_values']) > 0) {

                                $item = $variant->variant_items()->create([
                                    'variant_item_label' => $varItem['variant_item_label']
                                ]);

                                foreach ($varItem['variant_item_values'] as $value) {

                                    $value['product_id'] = $product->id;
                                    $item->variant_item_values()->create($value);
                                }
                            }
                        }
                    }
                }
            }


            DB::commit();

            Cache::forget('products');
            Cache::forget('initial_products');

            return redirect()->route('product.index')->with('success', 'Berhasil mengupdate data product');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('product.index')->with('error', $th->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        DB::beginTransaction();

        try {
            if ($product->assets) {

                foreach ($product->assets as $asset) {
                    File::delete('upload/images/' . $asset->filename);
                }
                $product->assets()->delete();
            }
            $product->delete();

            DB::commit();

            Cache::forget('products');
            Cache::forget('initial_products');

            return redirect()->route('product.index')->with('success', 'Berhasil menghapus data product');
            
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('product.index')->with('error', 'Gagal menghapus data product');
        }
    }
    public function addProductReview(Request $request)
    {
        $request->validate([
            'product_id' => ['required'],
            'name' => ['required'],
            'comment' => ['required'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
        ]);
        $product = Product::findOrFail($request->product_id);

        $product->reviews()->create([
            'comment' => $request->comment,
            'rating' => $request->rating,
            'name' => $request->name,
        ]);

        Cache::forget('products');
        Cache::forget('initial_products');

        return response()->json([
            'success' => true,
        ], 201);
    }
    public function loadProductReview(Request $request, $id)
    {
        $reviews = Review::where('product_id', $id)->latest()->skip($request->skip ?? 0)->take(6)->get();
        return response()->json([
            'success' => true,
            'results' => $reviews
        ]);
    }
}
