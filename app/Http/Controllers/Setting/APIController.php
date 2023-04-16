<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;


class APIController extends Controller
{
    public function index  ()
    {
        $config = Config::first();

        return view('admin.setting.api', compact('config'));
    }

    public function update ()
    {
        $attr = request()->validate([
            
        ]);
        
        

        $config = Config::first();
        $config->update($attr);

        return redirect()
            ->route('setting.api.index')
            ->with('success', 'Berhasil mengupdate');
    }
}
