<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code');
            $table->integer('discount')->default(false);
            $table->enum('discount_type', ['persen', 'nominal'])->nullable();
            $table->integer('min_checkout')->nullable()->comment('Minimal belanja untuk aktivasi discount');
            $table->integer('max_discount')->nullable()->comment('Maksimal Discount yang di peroleh (nominal)');
            $table->integer('max_use')->nullable()->comment('Maksimal penggunaan voucher');
            $table->integer('is_enable')->default(1)->comment('Apakah voucher aktif');
            $table->date('expire_at');
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
        Schema::dropIfExists('coupon');
    }
};
