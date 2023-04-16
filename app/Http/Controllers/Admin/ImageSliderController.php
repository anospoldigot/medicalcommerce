<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageSliderController extends Controller
{
    public function destroy($link, $filename)
    {
        $where = [
            'link'          => $link,
            'filename'      => $filename
        ];

        $slider = Slider::where($where)->first();

        try {
            $slider->delete();
            File::delete(public_path('upload/images/' . $slider->filename));
            $message = [
                'status_code'       => 200,
                'success'           => true,
                'message'           => 'Berhasil menghapus image slider'
            ];
        } catch (Exception $e) {
            $message = [
                'status_code'       => 500,
                'success'           => false,
                'message'           => 'Gagal menghapus image slider'
            ];
        }

        return response()->json($message);
    }
}
