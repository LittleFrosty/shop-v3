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
      Schema::create('product_attributes', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('product_id');
        $table->unsignedBigInteger('attribute_id');
        $table->unsignedBigInteger('attribute_value_id');
        $table->unique(['product_id', 'attribute_id', 'attribute_value_id'], 'product_attributes_unique');
        $table->index('product_id');
        $table->index('attribute_id');
        $table->index('attribute_value_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
};
