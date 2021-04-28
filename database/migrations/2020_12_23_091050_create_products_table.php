<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->integer('regular_price');
            $table->integer('sell_price')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('stock_out')->default(0);
            $table->string('sku')->nullable();
            $table->string('year')->nullable();
            $table->integer('page')->nullable();

            $table->unsignedBigInteger('publisher_id');
            $table->foreign('publisher_id')->references('id')->on('users');
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->unsignedBigInteger('format_id');
            $table->foreign('format_id')->references('id')->on('formats');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages');

            $table->string('image')->nullable();
            $table->text('gallery')->nullable();
            $table->string('social_image')->nullable();
            $table->string('seo_key_word')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('products');
    }
}
