<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $duitkuConfig;
    private $config;
    private $merchantCode   = 'DS12776';
    private $merchantKey    = '14e82f3fd51b5518b435ee4970fc7534';
    private $callbackUrl    = 'https://71e9-116-206-9-25.ngrok-free.app/api/payment/callback';
    private $returnUrl;

    public function __construct()
    {
        $this->duitkuConfig = new \Duitku\Config($this->merchantKey, $this->merchantCode);
        // false for production mode
        // true for sandbox mode
        $this->duitkuConfig->setSandboxMode(true);
        // set sanitizer (default : true)
        $this->duitkuConfig->setSanitizedMode(false);
        // set log parameter (default : true)
        $this->duitkuConfig->setDuitkuLogs(true);

        $config = Config::first();
        $this->config = $config;
        $this->merchantCode     = $config->merchant_code;
        $this->merchantKey      = $config->merchant_key;
        $this->callbackUrl      = $config->callback_url;
        $this->returnUrl        = $config->return_url;

    }
    
    public function index()
    {
        
        try {
            $paymentAmount = request('amount');
            $paymentMethodList = \Duitku\Api::getPaymentMethod($paymentAmount, $this->duitkuConfig);
            $paymentMethodList = json_decode($paymentMethodList);

            return response()->json([
                'status_code'   => 200,
                'message'       => 'Berhasil mengambil pembayaran',
                'data'          => $paymentMethodList->paymentFee
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status_code'   => 200,
                'message' =>  $e->getMessage()
            ], 500);
        }
    }
}
