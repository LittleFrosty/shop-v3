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
    public function up()
    {
        Schema::create('cart_notes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('cart_id')->index();
            $table->longText('note')->nullable();
            $table->string('status', 50)->default('0');
            $table->dateTime('date_added');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_notes');
    }
};
