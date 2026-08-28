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
      Schema::create('product_options', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('product_id');
        $table->unsignedBigInteger('option_id');
        $table->unsignedBigInteger('option_value_id');
        $table->unique(['product_id', 'option_id', 'option_value_id'], 'product_options_unique');
        $table->index('product_id');
        $table->index('option_id');
        $table->index('option_value_id');
        $table->decimal('price');
        $table->integer('quantity');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_options');
    }
};
