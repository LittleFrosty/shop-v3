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
      Schema::create('localisation_translates', function (Blueprint $table) {
        $table->id();
        $table->longText('title');
        $table->longText('description');
        $table->string('type');
        $table->unsignedBigInteger('item_id');
        $table->string('locale',50);
        $table->unique(['type', 'item_id', 'locale'], 'localisation_translates_unique');
        $table->index('type');
        $table->index('item_id');
        $table->index('locale');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localisation_translates');
    }
};
