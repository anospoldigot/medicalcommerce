<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    
    private $duitkuConfig;
    private $merchantCode   = 'DS12776';
    private $merchantKey    = '14e82f3fd51b5518b435ee4970fc7534';
    private $callbackUrl    = 'https://medicalcommerce.test/callback';
    private $returnUrl      = 'https://medicalcommerce.test/callback';

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
    }


    public function index ()
    {


        return view('frontend.payment.index');
    }
    
    /**
     * Get Payment.
     *
     */

    public function checkout ()
    {

        try {
            $paymentAmount = "10000"; //"YOUR_AMOUNT";
            $paymentMethodList = \Duitku\Api::getPaymentMethod($paymentAmount, $this->duitkuConfig);
            $paymentMethodList = json_decode($paymentMethodList);

            return $paymentMethodList;
            return view('frontend.payment.checkout');
        } catch (Exception $e) {
            return $e->getMessage();
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
            $price = 0;

            if ($product->is_discount > 0) {
                $price = $product->price;
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
            'price'     => 10000,
            'quantity'  => 1
        );

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
                'amount'                    => $paymentAmount,
                'expired_time'              => $expiryPeriod,
            ]);

            $products->each(function ($value, $key) use ($order) {
                $product = Product::find($value);
                $order->items()->create([
                    'name'          => $product->title,
                    'sku'           => $product->sku,
                    'product_id'    => $value,
                    'quantity'      => request('quantity')[$key],
                    'price'         => $product->price * request('quantity')[$key]
                ]);
            });
            
            return redirect()->route('fe.payment.show', $order->id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    
    public function callback ()
    {
        
        // Order::where('order_ref', request('referenceNo'))->update([
            
        // ]);

        return redirect()->route('fe.payment.show', request('referenceNo'));
    }

    public function show ($id)
    {
        $order = Order::with('transaction')->findOrFail($id);

        $transactionList = \Duitku\Api::transactionStatus($order->transaction->merchant_order_id, $this->duitkuConfig);
        $transaction = json_decode($transactionList);
        
        return view('frontend.payment.show', compact('order', 'transaction'));
    }
}
