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
      $table->string('order_no')->nullable();
      $table->string('currency')->nullable();
      $table->string('payment_method')->nullable();
      $table->integer('total')->default(0);
      $table->integer('item')->default(0);
      $table->integer('discount')->default(0);
      $table->string('status')->nullable();
      $table->integer('order_status')->default(0)->comment('0 = Processing, 1 = Ready, 2 = Shipping, 3 = Delivered, 4 = Cancelled');
      $table->dateTime('delivered_date')->nullable();
      $table->dateTime('ready_date')->nullable();
      $table->dateTime('cancel_date')->nullable();
      $table->integer('shipping_charge')->default(0);
      $table->timestamps();

      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('coupon_id')->nullable();
      $table->unsignedBigInteger('shipping_address_id');

      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('coupon_id')->references('id')->on('coupons');
      $table->foreign('shipping_address_id')->references('id')->on('shipping_addresses');

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
