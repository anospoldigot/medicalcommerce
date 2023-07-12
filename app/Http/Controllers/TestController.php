<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Helpers\ReferralHelper;
use App\Models\Config;
use App\Models\Transaction;
use App\Models\User;
use App\Jobs\NotifyUserOfCompletedExport;
use App\Models\Order;
use App\Notifications\OrderConfirmAndSend;
use App\Notifications\OrderCreated;
use App\Notifications\ReferrerBonus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Facades\Excel;

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

        $user = User::find(3);

        $user->notify(new OrderConfirmAndSend(Order::latest()->first()));

        return 'sukses';
    }
}
