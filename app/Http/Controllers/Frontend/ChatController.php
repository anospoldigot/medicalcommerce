<?php

namespace App\Http\Controllers\Frontend;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class ChatController extends Controller
{
    public function index ()
    {

        $data = Message::where('from_id', auth()->id())
            ->orWhere('to_id', auth()->id())
            ->latest()
            ->take(10)
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            })
            ->sortKeys();

        return response()->json([
            'success'       => true,
            'status_code'   => 200,
            'data'          => $data
        ]);
    }

    public function store ()
    {
        Message::create([
            'from_id'       => auth()->id(),
            'from_type'     => 'user',
            'content'       => request('content'),
        ]);

        return response()->json([
            'success'       => true,
            'status_code'   => 200,
        ], 201);
    }
}
