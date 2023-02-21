<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index ()
    {
        $user = auth()->user();

        return view('frontend.profile.index', compact('user'));
    }
}
