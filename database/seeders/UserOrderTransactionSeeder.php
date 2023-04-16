<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserOrderTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(100)->create()->each(function($user){
            $user->assignRole('customer');
            $data = [
                'province_id'       => 32,
                'regency_id'        => 3201,
                'district_id'       => 3201170,
                'village_id'        => 3201170001,
                'postal_code'       => 11240,
                'detail'            => 'Jl. Pejagalan Raya',
                'latitude'          => '-6.407595511848003',
                'longitude'         => '106.99576377868654',
                'is_priority'       => 1
            ];

            $data['rawdata'] = json_encode($data);

            $user->addresses()->create($data);
            
            $products = Product::inRandomOrder()
                ->take(2)
                ->get();


            $product_amount     = $products->sum('price');
            $shipping_amount    = 18000;
            $ppn_amount         = ($product_amount  / 100) * 11;
            $grand_total        = $product_amount + $shipping_amount + $ppn_amount;

            Order::factory()->count(20)->create([
                'user_id'  => $user->id,
                'address_id' => $user->default_address->id,
                // 'amount'            => $grand_total,
                'amount_after_disc' => $grand_total,
                'ppn_amount'        => $ppn_amount,
                'shipping_amount'   => $shipping_amount,
            ])->each(function($order) use ($products, $grand_total){
                $products->each(function($product) use($order){
                    OrderItem::factory()->create([
                        'product_id'        => $product->id,
                        'name'              => $product->title,
                        'sku'               => $product->sku,
                        'order_id'          => $order->id,
                        'price'             => $product->price,
                        'price_after_disc'  => $product->price,
                        'quantity'          => 1,
                        'created_at'        => $order->created_at
                    ]);
                });

                


                Transaction::factory()->create([
                    'order_id'          => $order->id,
                    'amount'            => $grand_total,
                    'paid_at'           => $order->created_at,
                    'created_at'        => $order->created_at
                ]);
                
            });
        });
    }
}
