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
      Schema::create('modules', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('url');
        $table->string('type')->default('module');
        $table->string('icon');
        $table->string('description');
        $table->string('code')->unique();
        $table->integer('global_status');
        $table->integer('status');
        $table->longText('content');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
