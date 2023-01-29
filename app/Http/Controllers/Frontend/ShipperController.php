<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShipperController extends Controller
{
    private $authorization = 'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiUGVtZWRpayIsInVzZXJJZCI6IjYzZDMwMzMyOWFiOTQ1MTIyYjY3NWE0NyIsImlhdCI6MTY3NDc3MzQ0M30.IAjCyQMVlIzLWFkKnKbDKFc8AFVwVLYFkeFy-ncT_eg';

    public function check ()
    {   

        $response = Http::withHeaders([
            'authorization' => $this->authorization
        ])
        ->post('https://api.biteship.com/v1/rates/couriers');


        return $response;
    }
}
