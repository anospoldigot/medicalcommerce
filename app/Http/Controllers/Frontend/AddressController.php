<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store()
    {
        $data               = request()->all();
        $data['user_id']    = auth()->id();
        $data['is_priority']= 1;
        $data['rawdata']    = json_encode(request()->all());

        
        Address::create($data);

        return view('frontend.cart._address', [
            'addresses' => Address::where('user_id', auth()->id())->get()
        ]);
    }
}
