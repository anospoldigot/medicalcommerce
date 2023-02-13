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
            $table->foreignUuid('coupon_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status')->nullable(); 
            $table->string('shipping_type')->nullable();
            $table->string('shipping_courier_code')->nullable();
            $table->string('shipping_courier_name')->nullable();
            $table->string('shipping_courier_service')->nullable();
            $table->integer('shipping_cost')->nullable();
            $table->mediumText('shipping_address')->nullable();
            $table->timestamp('shipping_delivered')->nullable();
            $table->timestamp('shipping_received')->nullable();
            $table->mediumText('note')->nullable();
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
