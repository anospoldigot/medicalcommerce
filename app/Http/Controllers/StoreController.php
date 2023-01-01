<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Block;
use App\Models\Config;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Store as Shop;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $shop = Cache::rememberForever('shop', function () {
            return Shop::first();
        });


        $config = Cache::rememberForever('shop_config', function () {
            return Config::first();
        });


        return view('admin.setting.store', compact('config', 'shop'));
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|numeric'
        ]);

        DB::beginTransaction();

        try {
            $shop = Shop::first();

            $path = public_path('/upload/images');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true, true);
            }

            $shop->name = $request->name;
            $shop->phone = $request->phone;
            if (!$shop->slug) {
                $shop->slug = $request->name ? Str::slug($request->name) : null;
            }
            $shop->address = $request->address;
            $shop->description = $request->description;

            if ($request->boolean('is_remove_logo')) {
                if ($shop->logo_path) {
                    File::delete($shop->logo_path);
                    File::delete(
                        'icon/logo.png',
                        'icon/icon-384x384.png',
                        'icon/icon-256x256.png',
                        'icon/icon-192x192.png',
                        'icon/icon-180x180.png',
                        'icon/icon-167x167.png',
                        'icon/icon-152x152.png',
                        'icon/icon-144x144.png',
                        'icon/icon-128x128.png',
                        'icon/icon-120x120.png',
                        'icon/icon-96x96.png',
                        'icon/favicon.png'
                    );
                    $shop->logo_path = NULL;
                }
            }

            if ($file = $request->file('logo')) {
                if ($shop->logo_path) {
                    File::delete($shop->logo_path);
                }

                $iconPath = public_path('/icon');

                if (!File::isDirectory($iconPath)) {

                    File::makeDirectory($iconPath, 0777, true, true);
                }

                $rawFile = Image::make($file);

                $rawFile->resize(384, 384)->encode('png')->save('icon/logo.png');
                $rawFile->resize(384, 384)->encode('png')->save('icon/icon-384x384.png');
                $rawFile->resize(256, 256)->encode('png')->save('icon/icon-256x256.png');
                $rawFile->resize(192, 192)->encode('png')->save('icon/icon-192x192.png');
                $rawFile->resize(180, 180)->encode('png')->save('icon/icon-180x180.png');
                $rawFile->resize(167, 167)->encode('png')->save('icon/icon-167x167.png');
                $rawFile->resize(152, 152)->encode('png')->save('icon/icon-152x152.png');
                $rawFile->resize(144, 144)->encode('png')->save('icon/icon-144x144.png');
                $rawFile->resize(128, 128)->encode('png')->save('icon/icon-128x128.png');
                $rawFile->resize(120, 120)->encode('png')->save('icon/icon-120x120.png');
                $rawFile->resize(96, 96)->encode('png')->save('icon/icon-96x96.png');
                $rawFile->resize(64, 64)->encode('png')->save('icon/favicon.png');

                $filename = Str::random(20) . '.' . $file->extension();

                $file->move($path, $filename);

                $shop->logo_path = 'upload/images/' . $filename;

            }

            $shop->save();

            DB::commit();
            Cache::forget('shop');

            return redirect()->route('dashboard');
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->route('dashboard');
        }
    }
    /**
     * Display a listing of the initial data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInitialData()
    {
        // Cache::flush();

        $sliders = Cache::rememberForever('sliders', function () {
            return Slider::OrderBy('weight', 'asc')->get();
        });

        $blocks = Cache::rememberForever('blocks', function () {
            return Block::with('post')->OrderBy('weight', 'asc')->get();
        });

        $shop = Cache::rememberForever('shop', function () {
            return Shop::first();
        });
        $categories = Cache::rememberForever('categories', function () {
            return Category::orderBy('weight', 'asc')->get();
        });
        $posts = Cache::rememberForever('promote_post', function () {
            return Post::promote()->latest()->take(5)->get();
        });
        $config = Cache::rememberForever('shop_config', function () {
            return Config::first();
        });

        $initialProducts = Cache::rememberForever('initial_products', function () use ($categories) {

            $item = [];

            foreach ($categories as $cat) {

                if ($cat->is_front) {

                    $data = new Collection();
                    $data['title'] = $cat->title;
                    $data['category_id'] = $cat->id;
                    $data['category_slug'] = $cat->slug;
                    $data['id'] = Str::random(16);
                    $data['banner_src'] = $cat->banner ? $cat->banner_src : '';
                    $data['description'] = $cat->description ?? '';
                    $data['items'] = Product::with('assets', 'category')->where('category_id', $cat->id)->take(8)->get();

                    $item[] = $data;
                }
            }

            return $item;
        });

        // dd($initialProducts);

        return response()->json([
            'success' => true,
            'results' => [
                'products' => $initialProducts,
                'sliders' => $sliders,
                'categories' => $categories,
                'blocks' => $blocks,
                'shop' => $shop,
                'posts' => $posts,
                'config' => $config,
                'sess_id' => Str::random(40),
            ]

        ], 200);
    }
}
