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
      Schema::create('importer', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('jsonFile');
        $table->string('jsonProductKey')->nullable();
        $table->string('category_id')->nullable();
        $table->longText('storeKeys');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('importer');
    }
};
