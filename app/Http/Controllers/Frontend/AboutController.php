<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Exception;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index ()
    {
        $config = Config::first();
        $contact = collect(json_decode($config->contact))->groupBy('type');
        try {
            $merchantCode   = 'DS12776';
            $merchantKey    = '14e82f3fd51b5518b435ee4970fc7534';
            $duitkuConfig = new \Duitku\Config($merchantKey, $merchantCode);
            $duitkuConfig->setSandboxMode(true);
            $duitkuConfig->setSanitizedMode(false);
            $duitkuConfig->setDuitkuLogs(true);
            $paymentAmount = "100000";
            $paymentMethodList = \Duitku\Api::getPaymentMethod($paymentAmount, $duitkuConfig);
            $paymentMethodList = json_decode($paymentMethodList);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        
        return view('frontend.about.index', compact('contact', 'paymentMethodList'));
    }
}
