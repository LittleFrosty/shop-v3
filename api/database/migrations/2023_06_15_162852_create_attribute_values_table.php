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
      Schema::create('attribute_values', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('attribute_id')->index();
        $table->integer('sort_order');
        $table->string('color')->default('#000000');
        $table->string('value');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_values');
    }
};
