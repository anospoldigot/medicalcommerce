<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class TransactionsExport implements FromQuery, ShouldQueue
{
    use Exportable;

    public function query()
    {
        return Transaction::query();
    }
}
