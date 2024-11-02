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
            $table->id();
            $table->unsignedBigInteger('number')->unique();
            $table->string('coupon_code')->nullable();
            $table->unsignedDouble('coupon_percent')->nullable();
            $table->unsignedDouble('coupon_discount_money')->nullable();
            $table->unsignedDouble('products_price');
            $table->unsignedDouble('value_added_tax');
            $table->unsignedDouble('delivery_price');
            $table->unsignedDouble('final_price');
            $table->unsignedTinyInteger('status');
            $table->text('reason_for_refused')->nullable();
            $table->foreignId('user_address_id')->references('id')->on('user_addresses')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
