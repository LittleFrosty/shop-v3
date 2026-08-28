<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
      Schema::create('option_values', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('value');
        $table->unsignedBigInteger('option_id')->index();
        $table->string('additional_value')->nullable();
        $table->integer('sort_order');
      });
    }
    
    public function down(){
      Schema::dropIfExists('option_values');
    }
};
