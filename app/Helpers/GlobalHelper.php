<?php

use Illuminate\Support\Facades\DB;

function getCartCount()
{
    return DB::table('carts')->where('user_id', auth()->id())->count();
}

 function generateInvoiceCode($table, $column, $prefix = 'INV-')
{
    $year = date('Ymd');
    $lastInvoice = DB::table($table)->latest($column)->first();

    if ($lastInvoice) {
        $number = intval(substr($lastInvoice->{$column}, -4)) + 1;
        $number = str_pad($number, 4, '0', STR_PAD_LEFT);
    } else {
        $number = '0001';
    }
    $invoiceCode = $prefix . $year . '-' . $number;

    return $invoiceCode;
}





?>