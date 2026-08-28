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
        Schema::create('yanak_soft', function (Blueprint $table) {
          $table->id();
          $table->string('username');
          $table->string('email');
          $table->string('bearer_token',256);
          $table->string('token_expires_at',256);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yanak_soft');
    }
};
