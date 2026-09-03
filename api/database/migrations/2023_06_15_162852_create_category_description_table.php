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
        Schema::create('category_description', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('category_id')->index();
          $table->longText('title');
          $table->longText('description');
          $table->string('meta_title',256);
          $table->string('meta_description',256);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_description');
    }
};
