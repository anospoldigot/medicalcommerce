<?php

namespace Silehage\Tripay;

class Tripay 
{
  protected $apikey;
  protected $private_key;
  protected $merchant_code; 
  protected $url_endpoint;

  public function __construct()
  {

      $this->apikey        = config('tripay.api_key');
      $this->private_key   = config('tripay.private_key');
      $this->merchant_code = config('tripay.merchant_code');
      $this->url_endpoint  = config('tripay.api_url');  

      if(config('tripay.mode') == 'sanbox') {
        $this->url_endpoint  = config('tripay.api_sanbox_url');  
      }

  }

  public function paymentChanels()
  {

    $result = $this->curlGet('/merchant/payment-channel');

    return $result;
  }

  public function createTransaction($payload)
  {
    $payload['callback_url'] = route('tripay.callback');
    $payload['expired_time'] = (time()+(24*60*60)); // 24 jam
    $payload['signature'] = $this->getSignature($payload['merchant_ref'], $payload['amount']);

    $result = $this->curlPost('/transaction/create', $payload);

    return $result;

    $arr =  array (
      'success' => true,
      'message' => '',
      'data' => 
      array (
        'reference' => 'T0001000000000000006',
        'merchant_ref' => 'INV345675',
        'payment_selection_type' => 'static',
        'payment_method' => 'BRIVA',
        'payment_name' => 'BRI Virtual Account',
        'customer_name' => 'Nama Pelanggan',
        'customer_email' => 'emailpelanggan@domain.com',
        'customer_phone' => '081234567890',
        'callback_url' => 'https://domainanda.com/callback',
        'return_url' => 'https://domainanda.com/redirect',
        'amount' => 1000000,
        'fee_merchant' => 1500,
        'fee_customer' => 0,
        'total_fee' => 1500,
        'amount_received' => 998500,
        'pay_code' => '57585748548596587',
        'pay_url' => NULL,
        'checkout_url' => 'https://tripay.co.id/checkout/T0001000000000000006',
        'status' => 'UNPAID',
        'expired_time' => 1582855837,
        'order_items' => 
        array (
          0 => 
          array (
            'sku' => 'PRODUK1',
            'name' => 'Nama Produk 1',
            'price' => 500000,
            'quantity' => 1,
            'subtotal' => 500000,
            'product_url' => 'https://tokokamu.com/product/nama-produk-1',
            'image_url' => 'https://tokokamu.com/product/nama-produk-1.jpg',
          ),
          1 => 
          array (
            'sku' => 'PRODUK2',
            'name' => 'Nama Produk 2',
            'price' => 500000,
            'quantity' => 1,
            'subtotal' => 500000,
            'product_url' => 'https://tokokamu.com/product/nama-produk-2',
            'image_url' => 'https://tokokamu.com/product/nama-produk-2.jpg',
          ),
        ),
        'instructions' => 
        array (
          0 => 
          array (
            'title' => 'Internet Banking',
            'steps' => 
            array (
              0 => 'Login ke internet banking Bank BRI Anda',
              1 => 'Pilih menu <b>Pembayaran</b> lalu klik menu <b>BRIVA</b>',
              2 => 'Pilih rekening sumber dan masukkan Kode Bayar (<b>57585748548596587</b>) lalu klik <b>Kirim</b>',
              3 => 'Detail transaksi akan ditampilkan, pastikan data sudah sesuai',
              4 => 'Masukkan kata sandi ibanking lalu klik <b>Request</b> untuk mengirim m-PIN ke nomor HP Anda',
              5 => 'Periksa HP Anda dan masukkan m-PIN yang diterima lalu klik <b>Kirim</b>',
              6 => 'Transaksi sukses, simpan bukti transaksi Anda',
            ),
          ),
        ),
        'qr_string' => NULL,
        'qr_url' => NULL,
      ),
    );

    return json_encode($arr);
  }

  public function transactionDetail($payload)
  {
  
    $result = $this->curlGet('/transaction/detail', $payload);

    return $result;
  }

  public function calculatorFee($payload)
  {
    $result = $this->curlGet('/merchant/fee-calculator', $payload);

    return $result;
  }

  protected function curlGet($endpoint, $payload = [])
  {
    $url = rtrim($this->url_endpoint,'/').'/'.ltrim($endpoint,'/');

    if(count($payload) > 0) {
      $url = $url . '?' .http_build_query($payload);
    }

    $curl = curl_init();

    $header = [
      'Authorization: Bearer '.$this->apikey
    ];

    curl_setopt($curl,CURLOPT_FRESH_CONNECT, true);
    curl_setopt($curl,CURLOPT_URL, $url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_HEADER,false);
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
    curl_setopt($curl,CURLOPT_FAILONERROR,false);

    $response = curl_exec($curl);
    $error = curl_error($curl);
    $errno  = curl_errno($curl);

    curl_close($curl);

    if($errno){
      return json_encode([
          'success' => false,
          'message' => $error,
          'connected' => false,
      ]);
    }else{

        return $response;
    }
  }

  protected function curlPost($endpoint,$data)
  {
      $url = rtrim($this->url_endpoint,'/').'/'.ltrim($endpoint,'/');
      
      $header = [
          'Authorization: Bearer '.$this->apikey
      ];
      $curl = curl_init();
      curl_setopt($curl,CURLOPT_FRESH_CONNECT,true);
      curl_setopt($curl,CURLOPT_URL,$url);
      curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
      curl_setopt($curl,CURLOPT_HEADER,false);
      curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
      curl_setopt($curl,CURLOPT_FAILONERROR,false);
      curl_setopt($curl,CURLOPT_POST,true);
      curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($data));
      curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
      curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

      $response = curl_exec($curl);
      $error = curl_error($curl);
      $errno  = curl_errno($curl);
      curl_close($curl);

      if($errno){
          return json_encode([
              'success' => false,
              'message' => $error,
              'connected' => false,
          ]);
      }else{
          return $response;
    }
  }

  protected function getSignature($orderRef, $orderTotal)
  {
      return hash_hmac('sha256', $this->merchant_code.$orderRef.$orderTotal, $this->private_key);
  }
}