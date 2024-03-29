<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('referrer_id')->nullable();
            $table->string('sku') ;
            $table->uuid('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('price_after_disc');
            $table->integer('discount_amount');
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
        Schema::dropIfExists('order_items');
    }
}
