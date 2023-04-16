<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('invoice_number');
            $table->foreignUuid('coupon_id')->nullable();
            $table->string('referrer_id')->nullable();
            $table->string('reference')->comment('Reference (Response from duitku)');
            $table->integer('merchant_order_id')->comment('Merchant Order Id (Response from duitku)');
            $table->string('biteship_order_id')->nullable();
            $table->string('biteship_tracking_id')->nullable();
            $table->string('biteship_waybill_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('address_id');
            $table->string('status')->nullable(); 
            $table->string('shipping_type')->nullable();
            $table->string('shipping_courier_code')->nullable();
            $table->string('shipping_courier_name')->nullable();
            $table->string('shipping_courier_service')->nullable();
            $table->integer('shipping_cost')->nullable();
            $table->mediumText('shipping_address')->nullable();
            $table->timestamp('shipping_delivered')->nullable();
            $table->timestamp('shipping_received')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_name')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('payment_proof')->nullable();
            $table->json('payment_request')->nullable();
            $table->json('payment_response')->nullable();
            $table->integer('amount_after_disc')->default(0);
            $table->integer('voucher_amount')->default(0);
            $table->integer('ppn_amount')->default(0);
            $table->integer('total_fee')->default(0);
            $table->integer('shipping_amount')->default(0);
            $table->mediumText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
