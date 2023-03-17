<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShipperController extends Controller
{
    private $authorization;
    private $address;


    public function __construct()
    {
        $config = Config::first();

        $this->authorization    = $config->biteship_token;
        $this->address          = $config->address;
    }

    public function couriers ()
    {   

        $response = Http::withHeaders([
            'authorization' => $this->authorization
        ])
        ->get('https://api.biteship.com/v1/couriers');


        return $response;
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
            'authorization' => $this->authorization
        ])
        ->post('https://api.biteship.com/v1/rates/couriers', $payload);


        return json_decode($response);
    }
}
