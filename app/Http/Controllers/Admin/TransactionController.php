<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Admin\TripayController;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Exception;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax()){
            $query = Transaction::latest()
                        ->when(request()->has('type'), function($q){
                            $q->where('type', request('type'));
                        })
                        ->when(request()->filled('min_amount'), function($q){
                            $q->where('amount', '>=',str_replace(",", "", request('min_amount')));
                        })
                        ->when(request()->filled('max_amount'), function($q){
                            $q->where('amount', '<=', str_replace(",", "", request('max_amount')));
                        })
                        ->when(request()->filled('start_date') && request()->filled('end_date'), function($q){
                            $q->whereBetween('created_at', [request('start_date'), request('end_date')]);
                        });

            return DataTables::of($query)
                ->addColumn('action', 'admin.transaction._action')
                ->toJson();
        }


        return view('admin.transaction.index');
    }


    public function store ()
    {
        $attr = request()->validate([
            'amount'        => 'required',
            'note'          => 'required',
            'type'          => 'required'
        ]);

        $attr['amount']         =  str_replace(",", "", request('amount'));
        $attr['status']         = 'paid';

        try {
            Transaction::create($attr);
            $message = [
                'status_code'       => 200,
                'success'           => true,
                'message'           => 'Berhasil membuat Transaksi'
            ];

        } catch (Exception $e) {
            $message = [
                'status_code'       => 500,
                'success'           => false,
                'message'           => 'Gagal membuat Transaksi'
            ];
        }

        return response()->json($message);
    }


    public function update (Transaction $transaction)
    {
        $attr = request()->validate([
            'amount'        => 'required',
            'note'          => 'required',
            'type'          => 'required'
        ]);


        try{
            $transaction->update($attr);
            $message = [
                'status_code'       => 200,
                'success'           => true,
                'message'           => 'Berhasil mengupdate Transaksi'
            ];
        }catch(Exception $e){
            $message = [
                'status_code'       => 500,
                'success'           => false,
                'message'           =>  'Gagal Mengupdate Transaksi'
            ];
        }   

        return response()->json($message);
    }


    public function destroy (Transaction $transaction)
    {
        try {
            $transaction->delete();
            $message = [
                'status_code'       => 200,
                'success'           => true,
                'message'           => 'Berhasil menghapus Transaksi'
            ];
        } catch (Exception $e) {
            $message = [
                'status_code'       => 500,
                'success'           => false,
                'message'           => 'Gagal menghapus Transaksi'
            ];
        }

        return response()->json($message);
    }


    

}
