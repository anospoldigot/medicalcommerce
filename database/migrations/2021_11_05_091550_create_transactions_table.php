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
            $table->enum('type', ['in', 'out'])->comment('type transaction');
            $table->uuid('order_id')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->integer('amount')->default(0);
            $table->integer('amount_received')->default(0);
            $table->integer('expired_time')->nullable();
            $table->string('status')->default('UNPAID');
            $table->mediumText('note')->nullable();
            $table->string('qr_url')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
