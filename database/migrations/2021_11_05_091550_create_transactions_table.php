<?php

use Faker\Provider\Medical;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->uuid('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('reference')->comment('Reference (Response from duitku)');
            $table->integer('merchant_order_id')->comment('Merchant Order Id (Response from duitku)');
            $table->string('payment_type')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_name')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('payment_proof')->nullable();
            $table->json('payment_request')->nullable();
            $table->json('payment_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->integer('amount')->default(0);
            $table->integer('amount_received')->default(0);
            $table->integer('total_fee')->default(0);
            $table->integer('expired_time')->nullable();
            $table->string('status')->default('UNPAID');
            $table->mediumText('note')->nullable();
            $table->string('qr_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
