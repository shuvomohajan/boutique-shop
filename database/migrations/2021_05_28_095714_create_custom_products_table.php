<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('shipping_address_id');
            $table->foreign('shipping_address_id')->references('id')->on('shipping_addresses')->cascadeOnDelete();

            $table->string('service');
            $table->string('front')->nullable();
            $table->string('back')->nullable();
            $table->string('sleeve')->nullable();
            $table->string('hemline')->nullable();
            $table->string('style')->nullable();
            $table->text('note')->nullable();
            $table->string('price')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 = Processing, 1 = Shipping, 2 = Delivered, 3 = Cancelled');
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
        Schema::dropIfExists('custom_products');
    }
}
