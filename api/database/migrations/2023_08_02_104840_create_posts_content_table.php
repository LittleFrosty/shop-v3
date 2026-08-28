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
      Schema::create('posts_content', function (Blueprint $table) {
        $table->id();
        $table->string('title', 256);
        $table->unsignedBigInteger('post_id');
        $table->string('language', 2);
        $table->unique(['post_id', 'language']);
        $table->index('post_id');
        $table->index('language');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_content');
    }
};
