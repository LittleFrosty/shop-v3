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
      Schema::create('vouchers', function (Blueprint $table) {
        $table->id();
        $table->string('title', 256);
        $table->string('code', 256)->unique();
        $table->string('type',64); // percent or fixed
        $table->integer('discount'); // percent or fixed
        $table->integer('min_price');
        $table->integer('quantity');
        $table->integer('status');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
