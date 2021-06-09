<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('experience')->nullable();
            $table->string('image')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->longText('about')->nullable();
            $table->boolean('status')->default(true);

            $table->string('otp_number')->nullable();
            $table->boolean('otp_status')->default(0);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
