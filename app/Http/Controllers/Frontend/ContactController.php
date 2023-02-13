<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index ()
    {
        $config = Config::first();
        $contact = collect(json_decode($config->contact))->groupBy('type');

        return view('frontend.contact.index', compact('contact'));
    }

    public function store ()
    {
        ContactForm::create(request()->except('_token'));


        return response()->json([
            'success'       => true,
            'status_code'   => 200,
            'message'       => 'Berhasil mengirim pesan'
        ], 200);
    }
}
