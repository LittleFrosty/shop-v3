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
      Schema::create('cart_products', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('cart_id')->index();
        $table->unsignedBigInteger('product_id')->index();
        $table->string('title');
        $table->integer('quantity');
        $table->string('image');
        $table->decimal('weight',8,2)->nullable();
        $table->decimal('price');
        $table->decimal('option_price_total')->nullable();
        $table->longText('options')->nullable();
        $table->string('options_ids')->index()->nullable();
        $table->decimal('discount');
        $table->decimal('total');
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
        Schema::dropIfExists('cart_products');
    }
};
