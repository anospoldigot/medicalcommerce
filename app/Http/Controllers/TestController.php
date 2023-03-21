<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        return User::find(1000000)->id;
        // $config =  Config::first();

        // return Http::withHeaders(['authorization'   => 'biteship_token'])
        //     ->get('https://api.biteship.com/v1/trackings/:id');
    }
}
