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
    public function up(){
      Schema::create('cart', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('user_id')->nullable()->index();
        $table->string('cart_token', 64)->nullable()->unique();
        $table->string('voucher_code',256)->nullable()->index();
        $table->integer('active_cart');
        $table->string('token',64)->nullable()->unique();
        $table->string('name', 256);
        $table->string('email', 256);
        $table->longText('additional_details')->nullable();
        $table->string('phone', 256);
        $table->string('city', 256);
        $table->string('address', 256);
        $table->longText('company');
        $table->string('payment_method', 256);
        $table->string('payment_status', 256)->nullable();
        $table->string('payment_token', 256)->nullable();
        $table->longText('additional_charges')->nullable();
        $table->decimal('additional_charges_total', 10, 2)->nullable()->default(0);
        $table->decimal('weight_price', 10, 2)->nullable()->default(0);
        $table->string('delivery_method', 256);
        $table->string('external_delivery_method', 256)->nullable();
        $table->decimal('delivery_price',10,2);
        $table->longText('tracking_number')->nullable();
        $table->string('status')->index();
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
        Schema::dropIfExists('cart');
    }
};
