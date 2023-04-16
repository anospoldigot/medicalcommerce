<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class SettingWebController extends Controller
{
    public function index()
    {
        return view('admin.settingweb.index', [
            'config' => Config::first()
        ]);
    }



    public function adminConfig()
    {
        $hiddenFields = [
            'rajaongkir_apikey',
            'tripay_api_key',
            'tripay_private_key',
            'tripay_merchant_code',
            'telegram_bot_token',
            'telegram_user_id',
        ];

        return response([
            'success' => true,
            'results' => Config::first()->makeVisible($hiddenFields)
        ], 200);
    }

    public function update(Request $request)
    {

        $rules = [
            'logo'      => 'nullable|image',
        ];


        if (request('is_ppn')) {
            $rules['ppn']    = 'required|numeric';
        }

        $attr = request()->validate($rules);

        if (!request('is_ppn')) {
            $rules['ppn']    = NULL;
        }
        
        if (request('logo')) {
            $path = public_path('/upload/images/');
            $filename = time() . '_' . Str::random(10) . '.webp';
            $attr['logo'] = $filename;
            Image::make(request('logo')->getRealPath())
                ->encode('webp', 80)
                ->save($path . $filename);
        }

        $config = Config::first();

        $config->update($attr);

        return redirect()->route('setting.web')->with('success', 'Berhasil mengupdate');
    }
}
