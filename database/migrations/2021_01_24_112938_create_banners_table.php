<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner1')->nullable();
            $table->string('banner1_url')->nullable();
            $table->string('banner2')->nullable();
            $table->string('banner2_url')->nullable();
            $table->string('banner3')->nullable();
            $table->string('banner3_url')->nullable();
            $table->string('banner4')->nullable();
            $table->string('banner4_url')->nullable();
            $table->string('banner5')->nullable();
            $table->string('banner5_url')->nullable();
            $table->string('banner6')->nullable();
            $table->string('banner6_url')->nullable();
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
        Schema::dropIfExists('banners');
    }
}
