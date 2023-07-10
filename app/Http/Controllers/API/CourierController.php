<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CourierController extends Controller
{
    public $config;
    public $address;

    public function __construct() {
        $config = Config::first();

        $this->config   = $config;
        $this->address  = $config->address;
    }

    public function index ()
    {
        $couriers = Http::withHeaders([
            'authorization' => $this->config->biteship_token
        ])
        ->get('https://api.biteship.com/v1/couriers');

        $couriers = json_decode($couriers);

        return response()->json([
            'status_code'       => 200,
            'message'           => 'Berhasil mengambil list courier',
            'data'              => $couriers->couriers
        ]);
    }


    public function check ()
    {

        $destination = Address::where('id', request('address_id'))->first();

        $payload = [
            'origin_latitude'       => $this->address->latitude,
            'origin_longitude'      => $this->address->longitude,
            'destination_latitude'  => $destination->latitude,
            'destination_longitude' => $destination->longitude,
            'couriers'              => request('courier'),
            'items'                 => request('items')
        ];

        $response = Http::withHeaders([
            'authorization' => $this->config->biteship_token
        ])
        ->post('https://api.biteship.com/v1/rates/couriers', $payload);

        return response()->json([
            'status_code'       => 200,
            'message'           => 'Berhasil cek ongkir',
            'data'              => json_decode($response)->pricing
        ]);
    }
}
