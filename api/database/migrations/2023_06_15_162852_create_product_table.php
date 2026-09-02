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
      Schema::create('product', function (Blueprint $table) {
        $table->id('id');
        $table->decimal('price',8,2)->index();
        $table->decimal('discount',8,2);
        $table->decimal('wholesale',8,2);
        $table->string('model', 256)->unique();
        $table->string('barcode', 256)->nullable()->unique();
        $table->decimal('weight',8,2)->default(0);
        $table->string('youtube', 256)->nullable();
        $table->integer('quantity');
        $table->longText('bundle_of_models')->nullable();
        $table->integer('out_of_stock_status')->default(0);
        $table->unsignedBigInteger('brand_id')->nullable()->index();
        $table->integer('status')->index();
        $table->string('url',256)->unique()->index();
        $table->integer('sort_order')->index();
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
        Schema::dropIfExists('product');
    }
};
