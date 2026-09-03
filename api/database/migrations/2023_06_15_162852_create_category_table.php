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
      Schema::create('category', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->boolean('top')->index();
        $table->string('status',12);
        $table->string('slug',256);
        $table->longText('image')->nullable();
        $table->unsignedBigInteger('parent_id')->nullable()->index();
        $table->integer('depth')->default(0);
        $table->integer('sort_order');
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
        Schema::dropIfExists('category');
    }
};
