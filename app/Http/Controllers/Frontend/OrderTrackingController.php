<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderTrackingController extends Controller
{
    public $config;

    public function __construct()
    {
        $this->config = Config::first();
    }

    public function index (Order $order)
    {
        $response = Http::withHeaders(['authorization' => $this->config->biteship_token])
            ->get('https://api.biteship.com/v1/trackings/' . $order->biteship_tracking_id);

        $response = json_decode($response);

        return view('frontend.tracking.index', compact('response'));
    }
}
