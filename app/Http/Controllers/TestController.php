<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Models\Config;
use App\Models\Transaction;
use App\Models\User;
use App\Jobs\NotifyUserOfCompletedExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        NotifyUserOfCompletedExport::dispatch(request()->user());
        return 'success';
    }
}
