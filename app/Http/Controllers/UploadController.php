<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function upload()
    {
        $image = request()->file('file');
        $filename = time() . Str::random(40) . '.webp';
        $directory = 'upload/images/';
        $path = public_path($directory);

        Image::make($image->getRealPath())
            ->encode('webp', 80)
            ->save($path . $filename);

        return response()->json(['success' => true, 'filename' => $directory . $filename]);
    }
}
