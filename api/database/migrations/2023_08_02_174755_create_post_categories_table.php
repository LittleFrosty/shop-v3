<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
      Schema::create('post_categories', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('title',256);
        $table->integer('status');
        $table->longText('image')->nullable();
        $table->integer('sort_order');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_categories');
    }
};
