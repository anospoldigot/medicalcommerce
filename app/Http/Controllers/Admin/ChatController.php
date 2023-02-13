<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index  ()
    {

        $users = User::with(['sender_latest', 'receiver_latest'])
                    ->where('role', 'customer')
                    ->get();

        return view('admin.chat.index', compact('users'));
    }

    public function show()
    {
        $data = Message::where('from_id', auth()->id())
                    ->orWhere('to_id', auth()->id())
                    ->get();

        return response()->json([
            'status_code' => 200,
            'success'     => true,
            'data' => $data
        ]);
    }

    public function store()
    {
        Message::create([
            'from_id'       => auth()->id(),
            'from_type'     => 'admin',
            'to_id'         => request('receiver_id'),
            'content'       => request('content'),
        ]);

        return response()->json([
            'success'       => true,
            'status_code'   => 200,
        ], 201);
    }
}
