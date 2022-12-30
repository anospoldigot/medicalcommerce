<?php

namespace Silehage\Rajaongkir;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RajaongkirController extends Controller
{

    public function getProvince()
    {
        $result = RajaongkirFacade::province();

        return $result;
    }
    public function getCity($provinceId)
    {
        $result = RajaongkirFacade::city($provinceId);

        return $result;
    }
    public function getSubdistrict($provinceId)
    {
        $result = RajaongkirFacade::subdistric($provinceId);

        return $result;
    }
    public function getCost(Request $request)
    {
       $data = $request->validate([
           'origin' => ['required', 'string'],
           'destination' => ['required', 'string'],
           'weight' => ['required'],
           'courier' => ['required', 'string'],
       ]);

        $result = RajaongkirFacade::cost($data);

        return $result;
    }
}
