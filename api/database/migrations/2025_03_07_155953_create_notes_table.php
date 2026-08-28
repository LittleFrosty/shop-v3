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
    Schema::create('notes', function (Blueprint $table) {
      $table->id();
      $table->string('belongs_to', 256)->index();
      $table->string('resource_id', 256)->index();
      $table->longText('note');
      $table->unsignedBigInteger('user_id')->index();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('notes');
  }
};
