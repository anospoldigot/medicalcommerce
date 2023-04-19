<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionsExport;
use App\Http\Controllers\Controller;
use App\Jobs\ExportTransactionJob;
use App\Models\User;
use App\Jobs\NotifyUserOfCompletedExport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TransactionReportController extends Controller
{
    public function index ()
    {
        $hasExcel = false;
        $hasPdf = false;
        if (Storage::exists('transaction-' . date('Ymd')  .'.xlsx')) $hasExcel = true;
        if (Storage::exists('transaction-' . date('Ymd')  .'.pdf'))  $hasPdf = true;

        return view('admin.transaction.report', compact('hasExcel', 'hasPdf'));
    }

    public function pdf()
    {
    }

    public function excel()
    {
        $filename = 'transaction-' . date('Ymd')  . '.xlsx';
        $path = public_path('storage/' . $filename);

        return response()->download($path , $filename);
    }

    public function excelGenerate()
    {

        $fileName = 'transactions.xlsx';
        $user = User::find(auth()->id());

        $startDate  = request('start_date');
        $endDate    = request('end_date');
        $minAmount  = request('min_amount');
        $maxAmount  = request('maxAmount');

        try{
            (new TransactionsExport($startDate, $endDate, $minAmount, $maxAmount))->queue('transaction-' . date('Ymd')  .'.xlsx')->chain([
                new NotifyUserOfCompletedExport(request()->user()),
            ]);

            $message = [
                'success'       => true,
                'message'       => 'Berhasil menjalankan proses export silahkan tunggu!'
            ];

            

        }catch(Exception $e){
            $message = [
                'success'       => false,
                'message'       => $e->getMessage()
            ];
        }
        
        return response()->json($message);
    }
}
