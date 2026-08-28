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
      Schema::create('localisation', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('language_code')->default('bg')->unique();
        $table->string('image');
        $table->integer('status')->default(1);
        $table->integer('primary')->default(0);
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localisation');
    }
};
