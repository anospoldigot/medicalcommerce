<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Helpers\ReferralHelper;
use App\Models\Config;
use App\Models\Transaction;
use App\Models\User;
use App\Jobs\NotifyUserOfCompletedExport;
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

        ReferralHelper::giveBonus('jaj86R');

        return 'success';
    }
}
