<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        

        return [
            'id'                    => Uuid::uuid4(),
            'invoice_number'        => generateInvoiceCode('orders', 'invoice_number'),
            'biteship_order_id'     => '6424500de1522d4cf9bc4978',
            'biteship_tracking_id'  => 'v8DKgsgS28pV9VzASSHPna5K',
            'biteship_waybill_id'  => 'WYB-1680101389727',
            'user_id'               => 0,
            'address_id'            => 0,
            'status'                => 'COMPLETE',
            'shipping_type'         => 'yes',  
            'shipping_courier_name' => 'jne',  
            'shipping_address'      => $this->faker->address(),
            'reference'             => 'DS1277623AZSSB1KN028VOXR',
            'merchant_order_id'     => '1680100958',
            'payment_method'        => 'BC',
            'payment_name'          => 'BCA VA',
            'payment_code'          => '7007014007799297',
            'amount_after_disc'     => 0,
            'voucher_amount'        => 0,
            'ppn_amount'            => 0,
            'shipping_amount'       => 0,
            'total_fee'             => 0,
            'created_at'            => $this->faker->dateTimeBetween('-2 year', 'now')
        ];
    }
}
