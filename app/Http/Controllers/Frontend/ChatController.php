<?php

namespace App\Http\Controllers\Frontend;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index ()
    {
        $data = [
            'message' => 'Hay kakakk'
        ];


        MessageEvent::dispatch($data);

        return 'ok';
    }
}
