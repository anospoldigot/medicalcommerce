<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
class CategoryController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Category::query())
                ->addIndexColumn()
                ->addColumn('action', 'admin.category._action')
                ->toJson();
        }

        return view('admin.category.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:categories',
            'images' => 'nullable|mimes:png,jpg,webp,jpeg,svg'
        ]);

        DB::beginTransaction();

        try {
            $path = public_path('/upload/images/');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true, true);
            }

            $category               = new Category();
            $category->title        = $request->title;
            $category->slug         = Str::slug($request->title);
            $category->is_front     = $request->boolean('is_front');
            // $category->weight       = $request->weight;

            $category->description = $request->description;

            if ($file = $request->file('image')) {
                $filename = Str::random(99) . '.webp';
                $category->image = $filename;
                Image::make(request()->file('image')->getRealPath())->fit(400)
                    ->encode('webp', 80)
                    ->save($path . $filename);
                
            }

            if ($file = $request->file('banner')) {

                $imageName = Str::random(41) . '.' . $file->extension();

                $file->move($path, $imageName);

                $category->banner = $imageName;
            }

            $category->save();

            DB::commit();

            Cache::forget('categories');
            Cache::forget('initial_products');

            return response([
                'success' => true,
                'message' => 'Berhasil menambah kategori',

            ], 201);
        } catch (\Throwable $th) {

            DB::rollBack();

            return response([
                'success' => false,
                'message' => $th->getMessage(),

            ], 400);
        }
    }
    public function show($id)
    {
        return response([
            'success' => true,
            'results' => Category::find($id)

        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            // 'weight' => 'required',
        ]);


        DB::beginTransaction();

        try {
            $category = Category::find($id);
            $category->title = $request->title;
            $category->is_front = $request->boolean('is_front');
            // $category->weight = $request->weight;
            $category->description = $request->description;

            $category->save();

            if ($file = $request->file('images')) {

                $oldAssets = $category->filename;

                $imageName = Str::random(39) . '.' . $file->extension();

                $file->move(public_path('/upload/images'), $imageName);

                File::delete('upload/images/' . $oldAssets);

                $category->filename = $imageName;
            }
            if ($request->boolean('remove_banner')) {

                File::delete('upload/images/' .  $category->banner);
                $category->banner = '';
            }
            if ($fileBanner = $request->file('banner')) {


                if ($category->banner) {
                    File::delete('upload/images/' . $category->banner);
                }

                $bannerName = Str::random(41) . '.' . $fileBanner->extension();

                $fileBanner->move(public_path('/upload/images'), $bannerName);


                $category->banner = $bannerName;
            }

            $category->save();

            DB::commit();

            Cache::forget('categories');
            Cache::forget('initial_products');

            return response([
                'success' => true,
                'message' => 'Berhasil memperbarui Kategori',

            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response([
                'success' => false,
                'message' => $th,

            ], 400);
        }
    }

    public function destroy($id)
    {
        $cat = Category::find($id);

        File::delete('upload/images/' . $cat->filename);
        File::delete('upload/images/' . $cat->bannerName);

        try {
            $cat->delete();

            Cache::forget('categories');
            Cache::forget('initial_products');

            session()->flash('success', 'Berhasil menghapus kategori');
        } catch (\Throwable $th) {
            session()->flash('error', 'Berhasil menghapus kategori');
        }

        return redirect()->route('category.index');
    }
}
