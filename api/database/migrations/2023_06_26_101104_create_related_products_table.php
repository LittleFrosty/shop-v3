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
        Schema::create('related_products', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('product_id');
          $table->unsignedBigInteger('related_id');
          $table->unique(['product_id', 'related_id']);
          $table->index('product_id');
          $table->index('related_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_products');
    }
};
