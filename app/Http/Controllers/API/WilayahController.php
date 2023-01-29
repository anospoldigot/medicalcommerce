<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function regencies($id)
    {

        return Province::find($id)->regencies;
    }

    public function districts($id)
    {

        return Regency::find($id)->districts;
    }

    public function villages($id)
    {

        return District::find($id)->villages;
    }
}
