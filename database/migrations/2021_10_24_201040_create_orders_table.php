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
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('merchant_order_id');
            $table->string('customer_name')->nullable();
            $table->string('customer_whatsapp')->nullable();
            $table->integer('order_qty');
            $table->integer('order_subtotal');
            $table->integer('order_weight');
            $table->integer('order_unique_code')->nullable();
            $table->integer('order_total')->default(0);
            $table->string('order_status')->nullable(); 
            $table->json('request_data')->nullable(); 
            $table->json('response_data')->nullable(); 
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
        Schema::dropIfExists('orders');
    }
}
