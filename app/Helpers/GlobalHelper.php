<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

function generateReferralCode()
{

    $code = Str::random(6);
    $existingCode = DB::table('users')->where('referral_token', $code)->first();

    if ($existingCode) {
        return generateReferralCode();
    }else{
        return $code;
    }

}

function shortNumber($n)
{
    if ($n < 1000000) {
        // Anything less than a million
        $n_format = number_format($n);
    } else if ($n < 1000000000) {
        // Anything less than a billion
        $n_format = number_format($n / 1000000, 3) . 'JT';
    } else {
        // At least a billion
        $n_format = number_format($n / 1000000000, 3) . 'M';
    }

    return $n_format;
}



?>