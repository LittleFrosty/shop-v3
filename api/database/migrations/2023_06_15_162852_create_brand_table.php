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
      Schema::create('brand', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('title', 256);
        $table->text("description");
        $table->string('meta_title', 256);
        $table->string("meta_description");
        $table->integer('sort_order');
        $table->string('slug',256);
        $table->string('image',256);
        $table->integer('status');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand');
    }
};
