<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
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
        
        // return request()->all();
        $products = collect(request('product'));
        $count = $products->count() + 1;
        // $cartData['item'] = $products->map(function ($value, $key) {
        //     $product = Product::find($value);
        //     return [
        //         'img_url'       => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone11-select-2019-family?wid=882&amp;hei=1058&amp;fmt=jpeg&amp;qlt=80&amp;op_usm=0.5,0.5&amp;.v=1567022175704',
        //         'goods_name'    => $product->title,
        //         'goods_detail'  => $product->description,
        //         'goods_amt'     => $product->price * request('quantity')[$key]

        //     ];
        // });


        // $cartData['item'][] = [
        //     'img_url'       => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone11-select-2019-family?wid=882&amp;hei=1058&amp;fmt=jpeg&amp;qlt=80&amp;op_usm=0.5,0.5&amp;.v=1567022175704',
        //     'goods_name'    => 'Ongkos Pengiriman',
        //     'goods_detail'  => 'Biaya Ongkos Pengiriman paket',
        //     'goods_amt'     => 10000
        // ];

        $user = auth()->user();
        $address = Address::find(request('address_id'));


        

        $paymentAmount      = request()->input('amt'); // Amount
        $paymentMethod      = "BT"; // Permata Bank Virtual Account
        $email              = "customer@gmail.com"; // your customer email
        $phoneNumber        = "081234567890"; // your customer phone number (optional)
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

        $address = array(
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
            'billingAddress'    => $address,
            'shippingAddress'   => $address
        );

        

        $itemDetails = $products->map(function ($value, $key) {
            $product = Product::find($value);
            return [
                'name'          => $product->title,
                'price'         => $product->price *  request('quantity')[$key] ,
                'quantity'      => request('quantity')[$key]
            ];
        });

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
            $dataOrder = [
                'user_id'               => $user->id,
                'order_ref'             => $responseDuitkuApi->reference,
                'order_qty'             => collect(request('quantity'))->sum(),
                'order_subtotal'        => request()->input('amt'),
                'order_weight'          => 2000,
                'order_total'           => $products->count(),
                'order_unique_code'     => rand(100000, 9999999),
                'merchant_order_id'     => $merchantOrderId,
                'request_data'          => json_encode($params),
                'response_data'         => json_encode($responseDuitkuApi)
            ];

            $order = Order::create($dataOrder);
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

        $transactionList = \Duitku\Api::transactionStatus($order->merchant_order_id, $this->duitkuConfig);
        $transaction = json_decode($transactionList);
        
        return view('frontend.payment.show', compact('order', 'transaction'));
    }
}
