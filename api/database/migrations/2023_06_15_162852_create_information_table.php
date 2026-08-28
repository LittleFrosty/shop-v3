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
        Schema::create('information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 256)->default('0');
            $table->string('thumbnail', 256)->nullable();
            $table->longText('description');
            $table->integer('status');
            $table->integer('agreements_at_order')->nullable()->default(0);
            $table->integer('agreement_at_contacts')->nullable()->default(0);
            $table->integer('show_in_footer')->nullable()->default(0);
            $table->integer('sort_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('information');
    }
};
