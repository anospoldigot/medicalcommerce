<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index ()
    {
        $config = Config::first();
        $contact = collect(json_decode($config->contact))->groupBy('type');
        
        return view('frontend.about.index', compact('contact'));
    }
}
