<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('posts_content_components', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('post_content_id')->index();
        $table->string('title', 256);
        $table->string('type', 32);
        $table->longText('content');
        $table->integer('sort_order');
        $table->integer('size');
        $table->integer('displayTitle');
        $table->integer('visible');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_content_components');
    }
};
