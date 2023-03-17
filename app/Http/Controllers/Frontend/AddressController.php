<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function store()
    {

        $rules = [
            'province_id'           => 'required',
            'regency_id'            => 'required',
            'district_id'           => 'required',
            'village_id'            => 'required',
            'detail'                => 'required',
            'postal_code'           => 'required',
            'latitude'              => 'required',
            'longitude'             => 'required',
        ];

        $message = [
            'province_id.required'          => 'Provinsi tidak boleh kosong',
            'regency_id.required'           => 'Kabupaten atau Kota tidak boleh kosong',
            'district_id.required'          => 'Kecamatan tidak boleh kosong',
            'village_id.required'           => 'Keluraha atau desa tidak boleh kosong',
            'detail.required'               => 'Detail Alamat tidak boleh kosong',
            'postal_code.required'          => 'Kode Pos tidak boleh kosong',
            'latitude.required'             => 'latitude tidak boleh kosong',
            'longitude.required'            => 'Longitude harus di isi',
        ];

        try{

            $validator = Validator::make(request()->all(), $rules, $message);
            
            if ($validator->fails()) {
                return response()->json([
                    'success'       => false,
                    'status_code'   => 422,
                    'message'       => $validator->errors()->first(),
                ], 422);
            }
    
            $data = [
                'province_id'           => request('province_id'),
                'regency_id'            => request('regency_id'),
                'district_id'           => request('district_id'),
                'village_id'            => request('village_id'),
                'detail'                => request('detail'),
                'postal_code'           => request('postal_code'),
                'latitude'              => request('latitude'),
                'longitude'             => request('longitude'),
                'user_id'               => auth()->id(),
                'is_priority'           => 1,
                'rawdata'               => json_encode(request()->all())
            ];

            Address::where('user_id', auth()->id())->update(['is_priority' => 0]);
            Address::create($data);  
            $addresses = Address::where('user_id', auth()->id())->get();
            return response()->json([
                'success'       => true,
                'status_code'   => 200,
                'message'       => 'Berhasil menambah alamat baru',
                'html'          => view('frontend.cart._address', compact('addresses'))->render()
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'success'       => false,
                'status_code'   => 500,
                'message'       => $e->getMessage()
            ], 500);
        }
    }
}
