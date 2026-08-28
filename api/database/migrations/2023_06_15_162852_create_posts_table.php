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
        Schema::create('posts', function (Blueprint $table) {
          $table->id();
          $table->string('type', 20);
          $table->unsignedBigInteger('category_id')->nullable()->index();
          $table->string('image', 256)->nullable();
          $table->integer('contact_form');
          $table->integer('archived')->default(0);
          $table->integer('status')->default(1)->index();
          $table->integer('sort_order');
          $table->integer('views')->default(0);
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
        Schema::dropIfExists('posts');
    }
};
