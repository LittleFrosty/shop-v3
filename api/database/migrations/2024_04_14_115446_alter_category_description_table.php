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
      Schema::table('category_description', function (Blueprint $table) {
        $table->string('url')->unique();
        $table->string('meta_title')->nullable();
        $table->string('meta_description')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_description', function (Blueprint $table) {
            $table->dropUnique(['url']);
            $table->dropColumn(['url', 'meta_title', 'meta_description']);
        });
    }
};
