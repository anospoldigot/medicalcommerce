<?php

namespace App\Jobs;

use App\Exports\TransactionsExport;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $transactions = Transaction::query()->chunk(1000, function($transactions){
            foreach ($transactions as $chunk) {
                $data = collect($chunk)->map(function ($item) {
                    return [
                        'id'            => $item->id,
                        'name'          => $item->name,
                        'amount'        => $item->amount,
                        'created_at'    => $item->created_at,
                        'updated_at'    => $item->updated_at,
                    ];
                });
    
                Excel::store(new TransactionsExport($data), $this->filename, 'local');
            }
        });

    }
}
