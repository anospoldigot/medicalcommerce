<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Config;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class OrderController extends Controller
{
    private $duitkuConfig;
    private $config;
    private $merchantCode   = 'DS12776';
    private $merchantKey    = '14e82f3fd51b5518b435ee4970fc7534';
    private $callbackUrl    = 'https://permedik.inttekno.com/api/payment/callback';
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
    
    public function store ()
    {

        $products = collect(request('products'));
        $count = $products->count() + 1;
        $user = request()->user();
        $address = Address::find(request('addressId'));      

        $paymentAmount      = request()->input('totalAmount'); // Amount
        $paymentMethod      = request()->input('paymentMethod');

        $email              = $user->email; // your customer email
        $phoneNumber        = $user->phone; // your customer phone number (optional)
        $productDetails     = "Test Payment";
        $merchantOrderId    = time(); // from merchant, unique   
        $customerVaName     = 'John Doe'; // display name on bank confirmation display
        $expiryPeriod       = 60; // set the expired time in minutes

        $itemDetails = $products->map(function($product){
            return [
                'name'      => $product['title'],
                'price'     => $product['real_price'],
                'quantity'  => $product['quantity']
            ];
        });

        if(request()->filled('code_coupon')){
            $itemDetails[]  = array(
                'name'      => 'Potongan Voucher',
                'price'     => -request('discountAmount'),
                'quantity'  => 1
            );
        }

        $itemDetails[]  = array(
            'name'      => 'Pengiriman',
            'price'     => request('shippingCost'),
            'quantity'  => 1
        );

        $itemDetails[]  = array(
            'name'      => 'Biaya Admin',
            'price'     => request('paymentFee'),
            'quantity'  => 1
        );

        $itemDetails[]  = array(
            'name'      => 'PPN ',
            'price'     => request('ppnAmount'),
            'quantity'  => 1
        );

        


        $params = array(
            'paymentAmount'     => $paymentAmount,
            'paymentMethod'     => $paymentMethod,
            'merchantOrderId'   => $merchantOrderId,
            'productDetails'    => $productDetails,
            'customerVaName'    => $customerVaName,
            'email'             => $email,
            'phoneNumber'       => $phoneNumber,
            'itemDetails'       => $itemDetails,
            'callbackUrl'       => $this->callbackUrl,
            'returnUrl'         => $this->returnUrl,
            'expiryPeriod'      => $expiryPeriod
        );

        

        try {
            DB::beginTransaction();

            $responseDuitkuApi = \Duitku\Api::createInvoice($params, $this->duitkuConfig);
            $responseDuitkuApi = json_decode($responseDuitkuApi);
            
            $dataOrder = [
                'user_id'                       => $user->id,
                'address_id'                    => $address->id,
                'referrer_type'                 => $this->config->referral_type,
                'note'                          => request('note'),
                'invoice_number'                => generateInvoiceCode('orders', 'invoice_number'),
                'reference'                     => $responseDuitkuApi->reference,
                'merchant_order_id'             => $merchantOrderId,
                'payment_name'                  => request('payment_name'),
                'payment_method'                => $paymentMethod,
                'payment_code'                  => $responseDuitkuApi->vaNumber,
                'payment_request'               => json_encode($params),
                'payment_response'              => json_encode($responseDuitkuApi),
                'amount_after_disc'             => $paymentAmount,
                'voucher_amount'                => request('voucherAmount'),
                'ppn_amount'                    => request('ppnAmount'),
                'shipping_amount'               => request('shippingCost'),
                'shipping_courier_name'         => request('courierCode'),
                'shipping_courier_service'      => request('courierServiceCode'),
                'shipping_type'                 => request('shipping_type'),
                'shipping_address'              => $address->province->name . ', ' . 
                $address->regency->name . ', ' . 
                $address->district->name . ', ' . 
                $address->village->name . ', ' . 
                $address->detail . ', ' . 
                $address->postal_code
            ];

            if (request()->has('referral_token')) {
                $dataOrder['referrer_id'] = request('referral_token');
            }
            
            $order = Order::create($dataOrder);

            $transaction = $order->transaction()->create([
                'amount'                    => $paymentAmount,
                'expired_time'              => $expiryPeriod,
            ]);
            
            $products->each(function ($product, $key) use ($order, $user) {
                $cart                   = Cart::where('user_id', $user->id)->where('product_id', $product['id'])->first();
                $item_id = Uuid::uuid4();

                $item = [
                    'id'                    => $item_id,
                    'name'                  => $product['title'],
                    'referrer_id'           => $cart->referrer_id ?? '',
                    'sku'                   => $product['sku'],
                    'product_id'            => $product['id'],
                    'quantity'              => $product['quantity'],
                    'price'                 => $product['price'],
                    'price_after_disc'      => $product['real_price'],
                    'discount_amount'       => $product['price'] - $product['real_price'],
                ];

                $order->items()->create($item);
                
            });

            Cart::where('user_id', $user->id)->whereIn('product_id', $products->pluck('id'))->delete();
            DB::commit();

            return response()->json([
                'status_code'       => 200,
                'message'           => 'Berhasil membuat order'
            ]);

        } catch (Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }
}
