<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Config;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PaymentController extends Controller
{

    
    private $duitkuConfig;
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

        $this->merchantCode     = $config->merchant_code;
        $this->merchantKey      = $config->merchant_key;
        $this->callbackUrl      = $config->callback_url;
        $this->returnUrl        = $config->return_url;

    }


    public function index ()
    {

        try {
            $paymentAmount = request('amount'); //"YOUR_AMOUNT";
            $paymentMethodList = \Duitku\Api::getPaymentMethod($paymentAmount, $this->duitkuConfig);
            $paymentMethodList = json_decode($paymentMethodList);

            return response()->json([
                'success'       => true,
                'status_code'   => 200,
                'message'       => 'Berhasil mengambil pembayaran',
                'html'          => view('frontend.payment.index', compact('paymentMethodList'))->render()
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success'       => true,
                'status_code'   => 200,
                'message' =>  $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get Payment.
     *
     */

    public function checkout ()
    {

        try {
            $paymentAmount = request('amount'); //"YOUR_AMOUNT";
            $paymentMethodList = \Duitku\Api::getPaymentMethod($paymentAmount, $this->duitkuConfig);
            $paymentMethodList = json_decode($paymentMethodList);

            return response()->json([
                'success'       => true,
                'status_code'   => 200,
                'message'       => 'Berhasil mengambil pembayaran', 
                'html'          => view('frontend.payment.checkout')->render()
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success'       => true,
                'status_code'   => 200,
                'message' =>  $e->getMessage()
            ], 500);
        }
    }


    /**
     * Create Invoice Payment.
     *
     */
    public function store ()
    {
        $products = collect(request('product'));
        $count = $products->count() + 1;
        $user = auth()->user();
        $address = Address::find(request('address_id'));      

        $paymentAmount      = request()->input('amt'); // Amount
        $paymentMethod      = request()->input('paymentMethod');
        $email              = $user->email; // your customer email
        $phoneNumber        = $user->phone; // your customer phone number (optional)
        $productDetails     = "Test Payment";
        $merchantOrderId    = time(); // from merchant, unique   
        $additionalParam    = ''; // optional
        $merchantUserInfo   = ''; // optional
        $customerVaName     = 'John Doe'; // display name on bank confirmation display
        $expiryPeriod       = 60; // set the expired time in minutes

        // Address
        $alamat             = "Jl. Kembangan Raya";
        $city               = "Jakarta";
        $countryCode        = "ID";

        // if(request()->has('code_coupon')) {
        //     $coupon = Coupon::where('code', request('code_coupon'))->first();

        //     return $coupon;
        //     $paymentAmount = 
        // }


        $billingAddress = array(
            'firstName'     => $user->name,
            'lastName'      => "",
            'address'       => $alamat,
            'city'          => $city,
            'postalCode'    => $address->postal_code,
            'phone'         => $phoneNumber,
            'countryCode'   => $countryCode
        );

        $customerDetail = array(
            'firstName'         => $user->name,
            'lastName'          => "",
            'email'             => $user->email,
            'phoneNumber'       => $user->phone,
            'billingAddress'    => $billingAddress,
            'shippingAddress'   => $address
        );

        

        $itemDetails = $products->map(function ($value, $key) {
            $product = Product::find($value);
            $price = $product->price;

            if ($product->is_discount > 0) {
                if ($product->discount_type == 'persen') {
                    $price = ($product->price / 100) * $product->discount;
                } else if ($product->discount_type == 'nominal') {
                    $price = $product->discount;
                }

                $price = $product->price - $price;
            }

            return [
                'name'          => $product->title,
                'price'         => $price *  request('quantity')[$key],
                'quantity'      => request('quantity')[$key]
            ];
        });

        if(request()->filled('code_coupon')){
            $itemDetails[]  = array(
                'name'      => 'Potongan Voucher',
                'price'     => -request('discount_amt'),
                'quantity'  => 1
            );
        }

        $itemDetails[]  = array(
            'name'      => 'Pengiriman',
            'price'     => request('shipping_amt'),
            'quantity'  => 1
        );

        $itemDetails[]  = array(
            'name'      => 'Biaya Admin',
            'price'     => request('fee_amt'),
            'quantity'  => 1
        );

        // return response()->json([
        //     'amount'    => $paymentAmount,
        //     'details'   => $itemDetails
        // ]);

        $params = array(
            'paymentAmount'     => $paymentAmount,
            'paymentMethod'     => $paymentMethod,
            'merchantOrderId'   => $merchantOrderId,
            'productDetails'    => $productDetails,
            'additionalParam'   => $additionalParam,
            'merchantUserInfo'  => $merchantUserInfo,
            'customerVaName'    => $customerVaName,
            'email'             => $email,
            'phoneNumber'       => $phoneNumber,
            'itemDetails'       => $itemDetails,
            'customerDetail'    => $customerDetail,
            'callbackUrl'       => $this->callbackUrl,
            'returnUrl'         => $this->returnUrl,
            'expiryPeriod'      => $expiryPeriod
        );

        try {
            // createInvoice Request
            $responseDuitkuApi = \Duitku\Api::createInvoice($params, $this->duitkuConfig);
            $responseDuitkuApi = json_decode($responseDuitkuApi);
            Cart::where('user_id', $user->id)->whereIn('product_id', request('product'))->delete();
            $dataOrder = [
                'user_id'               => $user->id,
                'note'                  => request('note'),
                'shipping_address'      => $address->province->name . ', ' . 
                $address->regency->name . ', ' . 
                $address->district->name . ', ' . 
                $address->village->name . ', ' . 
                $address->detail . ', ' . 
                $address->postal_code
            ];

            
            $order = Order::create($dataOrder);

            $transaction = $order->transaction()->create([
                'invoice_number'            => generateInvoiceCode('transactions', 'invoice_number'),
                'reference'                 => $responseDuitkuApi->reference,
                'merchant_order_id'         => $merchantOrderId,
                'payment_name'              => request('payment_name'),
                'payment_method'            => $paymentMethod,
                'payment_code'              => $responseDuitkuApi->vaNumber,
                'payment_request'           => json_encode($params),
                'payment_response'          => json_encode($responseDuitkuApi),
                'amount'                    => Product::whereIn('id', $products->all())->get()->sum('price'),
                'amount_after_disc'         => $paymentAmount,
                'voucher_amount'            => request('voucher_amt'),
                'expired_time'              => $expiryPeriod,
            ]);

            $products->each(function ($value, $key) use ($order) {
                $product = Product::find($value);
                $price_after_discount = 0;
                $discount = 0;
                if ($product->is_discount > 0) {
                    $discount = $product->price;
                    if ($product->discount_type == 'persen') {
                        $discount = ($product->price / 100) * $product->discount;
                    } else if ($product->discount_type == 'nominal') {
                        $discount = $product->discount;
                    }
                    $price_after_discount = $product->price - $discount;
                }

                $order->items()->create([
                    'name'                  => $product->title,
                    'sku'                   => $product->sku,
                    'product_id'            => $value,
                    'quantity'              => request('quantity')[$key],
                    'price'                 => $product->price,
                    'price_after_disc'      => $price_after_discount,
                    'discount_amount'       => $discount,
                ]);
            });
            
            return redirect()->route('fe.payment.show', $order->id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    
    public function callback ()
    {

        $apiKey = $this->merchantKey; // API key anda
        $merchantCode = request()->has('merchantCode') ? request('merchantCode') : null; 
        $amount = request()->has('amount') ? request('amount') : null; 
        $merchantOrderId = request()->has('merchantOrderId') ? request('merchantOrderId') : null; 
        $productDetail = request()->has('productDetail') ? request('productDetail') : null; 
        $additionalParam = request()->has('additionalParam') ? request('additionalParam') : null; 
        $paymentMethod = request()->has('paymentMethod') ? request('paymentMethod') : null; 
        $resultCode = request()->has('resultCode') ? request('resultCode') : null; 
        $merchantUserId = request()->has('merchantUserId') ? request('merchantUserId') : null; 
        $reference = request()->has('reference') ? request('reference') : null; 
        $signature = request()->has('signature') ? request('signature') : null; 

        $location = public_path('/payment-data.txt');
        
        if(!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature))
        {
            $params = $merchantCode . $amount . $merchantOrderId . $apiKey;
            $calcSignature = md5($params);

            if($signature == $calcSignature)
            {

                $where = [
                    'reference'            => $reference,
                    'merchant_order_id'     => $merchantOrderId,
                ];
                $transaction = Transaction::where($where)->first();
                $transaction->update([
                    'status'            => 'PAID',
                    'paid_at'           => date('Y-m-d H:i:s'),
                    'amount_received'   => $amount
                ]);

                $transaction->order()->update([
                    'status' => 'ISSUED'
                ]);

                $fileContent = "SUCCESS";
                file_put_contents($location, $fileContent);
                return response('OK', 200);

            }
            else
            {
                $fileContent = "Bad Signature";
                file_put_contents($location, $fileContent);
                return response('Bad Signature', 401);
            }
        }
        else
        {
            $fileContent = "Bad Parameter";
            file_put_contents($location, $fileContent);
            return response('Bad Parameter', 422);
        }
    }

    public function show ($id)
    {
        $order = Order::with('transaction')->findOrFail($id);

        $transactionList = \Duitku\Api::transactionStatus($order->transaction->merchant_order_id, $this->duitkuConfig);
        $transaction = json_decode($transactionList);
        
        return view('frontend.payment.show', compact('order', 'transaction'));
    }


}
