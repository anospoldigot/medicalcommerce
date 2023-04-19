<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class SliderController extends Controller
{
    public function index () 
    {
        if (request()->ajax()) {
            return DataTables::of(Slider::orderBy('link', 'asc'))
                ->addColumn('action', 'admin.slider._action')
                ->toJson();
            
        }
        
        return view('admin.slider.index');
    }

    public function create ()
    {
        return view('admin.slider.create');
    }

    public function store ()
    {
        
        $attr = request()->validate([
            'filename'      => 'required',
            'url'           => 'required'
        ]);
        
        try{
            $data_batch = collect(request('filename'))->map(function ($name) {
                Slider::create([
                    'filename'      => $name,
                    'link'           => request('url')
                ]);
            });
            return redirect()
                ->route('sliders.index')
                ->with('success', 'Berhasil menambahkan slider');

        }catch(Exception $e){
            return back()
                ->with('error',$e->getMessage());
        }
    }

    public function edit ($link)
    {
        $sliders = Slider::where('link', $link)->get();

        return view('admin.slider.create', compact('sliders'));
    }

 

    public function destroy($link)
    {

        $link = Crypt::decryptString($link);

        $sliders = Slider::where('link', $link)->get();

        try {
            $sliders->each(function($slider){
                $slider->delete();
                File::delete(public_path('upload/images/' . $slider->filename));
            });

            $message = [
                'status_code'       => 200,
                'success'           => true,
                'message'           => 'Berhasil menghapus slider'
            ];
        } catch (Exception $e) {
            $message = [
                'status_code'       => 500,
                'success'           => false,
                'message'           => 'Gagal menghapus slider'
            ];
        }

        return response()->json($message);
    }
}
