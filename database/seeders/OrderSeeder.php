<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expiryPeriod       = 60; // set the expired time in minutes
        $user = User::where('email', 'ramaramarama009@gmail.com')->first();
        $where = [
            'user_id'           => $user->id,
            'is_priority'       => 1
        ];
        $address = Address::where($where)->first();

        $dataOrder = [
            'user_id'                       => $user->id,
            // 'status'                        => 
            'address_id'                    => $address->id,
            'note'                          => request('note'),
            'shipping_courier_name'         => request('courier'),
            'shipping_courier_service'      => request('courier_servive'),
            'shipping_type'                 => request('shipping_type'),
            'shipping_address'              => $address->province->name . ', ' .
                $address->regency->name . ', ' .
                $address->district->name . ', ' .
                $address->village->name . ', ' .
                $address->detail . ', ' .
                $address->postal_code
        ];

        $order = Order::create($dataOrder);



        $transaction = $order->transaction()->create([
            'invoice_number'            => generateInvoiceCode('transactions', 'invoice_number'),
            'reference'                 => 'DS1277623AZSSB1KN028VOXR',
            'merchant_order_id'         => '1680100958',
            'payment_name'              => 'BCA VA',
            'payment_method'            => 'BC',
            'payment_code'              => '7007014007799297',
            'payment_request'           => NULL,
            'payment_response'          => NULL,
            'amount'                    => 918000,
            'amount_after_disc'         => 918000,
            'voucher_amount'            => 0,
            'shipping_amount'           => 18000,
            'expired_time'              => $expiryPeriod,
        ]);

        $product = Product::where('slug', '1-set-tool-medis-standar')->first();

        $order->items()->create([
            'id'                    => Uuid::uuid4(),
            'name'                  => $product->title,
            'sku'                   => $product->sku,
            'product_id'            =>  $product->id,
            'quantity'              => 1,
            'price'                 => $product->price,
            'price_after_disc'      => $product->price,
            'discount_amount'       => 0,
        ]);

        DB::commit();
    }
}
