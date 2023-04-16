<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class InvoiceController extends Controller
{
    public function pdf (Order $order)
    {   
        // return view('frontend.invoice.pdf');
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();
        $config = Config::first();
        $logo = public_path('upload/images/' . $config->logo);
        $ppn = $config->ppn;

        $pdf = pdf::loadView('frontend.invoice.pdf', compact('order', 'logo', 'ppn'));
        return $pdf
            ->setPaper('a4', 'portrait')
            ->setWarnings(false)
            ->stream();
            // ->download($order->transaction->invoice_number . '.pdf');
    }

    public function excel ()
    {

    }
}
