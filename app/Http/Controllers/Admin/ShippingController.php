<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Rajaongkir;

class ShippingController extends Controller
{
    public function getProvince()
    {
        if (Cache::has('provinces')) {

            return response()->json([
                'success' => true,
                'results' =>  Cache::get('provinces')
            ]);
        } else {

            $json = Rajaongkir::province();

            $obj = json_decode($json);

            if ($obj->success == true && count($obj->results) > 0) {

                Cache::forever('provinces', $obj->results);

                return response()->json($obj);
            } else {

                return response()->json([
                    'success' => false,
                    'message' => $obj->message
                ]);
            }
        }
    }

    public function getCity($province_id)
    {

        if (Cache::has('city_by_' . $province_id)) {

            return response()->json([
                'success' => true,
                'results' => Cache::get('city_by_' . $province_id)
            ]);
        } else {

            $json = Rajaongkir::city($province_id);

            $obj = json_decode($json);


            if ($obj->success == true && count($obj->results) > 0) {

                Cache::forever('city_by_' . $province_id, $obj->results);

                return response()->json($obj);
            } else {

                return response()->json([
                    'success' => false,
                    'message' => $obj->message
                ]);
            }
        }
    }
    public function getSubdistrict($city_id)
    {

        if (Cache::has('subdistrict_by_' . $city_id)) {

            return response()->json([
                'success' => true,
                'results' => Cache::get('subdistrict_by_' . $city_id)
            ]);
        } else {

            $json = Rajaongkir::subdistrict($city_id);
            $obj = json_decode($json);

            if ($obj->success == true && count($obj->results) > 0) {

                Cache::forever('subdistrict_by_' . $city_id, $obj->results);

                return response()->json($obj);
            } else {

                return response()->json([
                    'success' => false,
                    'message' => $obj->message
                ]);
            }
        }
    }
    public function getCost(Request $request)
    {
        $data = $request->validate([
            "origin"        => 'required',
            "destination"   => 'required',
            "weight"        => 'required',
            "courier"       => 'required',
        ]);

        $key = http_build_query($data);

        if (Cache::has($key)) {

            return response()->json([
                'success' => true,
                'results' => Cache::get($key)
            ]);
        } else {
            $config = Config::first();

            if ($config->rajaongkir_type == 'pro') {
                $data['originType'] = 'city';
                $data['destinationType'] = 'subdistrict';
            }

            $json = Rajaongkir::cost($data);

            $obj = json_decode($json);

            if ($obj->success == true && count($obj->results) > 0) {

                Cache::put($key, $obj->results, now()->addHours(8));

                return response()->json($obj);
            } else {

                return response()->json([
                    'success' => false,
                    'message' => $obj->message
                ]);
            }
        }
    }
}
