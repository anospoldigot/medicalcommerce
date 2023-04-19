<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class TransactionsExport implements FromQuery, ShouldQueue
{
    use Exportable;
    public $startDate   = null;
    public $endDate     = null;
    public $minAmount   = 0;
    public $maxAmount   = 0;

    public function __construct
    (
        $startDate, $endDate, $minAmount, $maxAmount
    )
    {
        $this->startDate        = $startDate;
        $this->endDate          = $endDate;
        $this->minAmount        = $minAmount;
        $this->maxAmount        = $maxAmount;
    }

    public function query()
    {
        return Transaction::query()
            ->when(!empty($this->startDate) && !empty($this->endDate), function($query){
                $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
            })
            ->when(!empty($this->minAmount), function($query){
                $query->where('amount', '>=', str_replace(",", "", $this->minAmount));
            })
            ->when(!empty($this->maxAmount) , function($query){
                $query->where('amount', '<=', str_replace(",", "", $this->maxAmount));
            });
    }

    public function map($invoice): array
    {
        return [
            $invoice->invoice_number,
            $invoice->user->name,
            Date::dateTimeToExcel($invoice->created_at),
        ];
    }
}
