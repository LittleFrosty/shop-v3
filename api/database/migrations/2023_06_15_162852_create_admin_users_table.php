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
      Schema::create('admin_users', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name', 128);
        $table->string('email', 256)->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->integer('status')->index();
        $table->string('locked_reason', 256)->nullable();
        $table->boolean('locked');
        $table->integer('main_account');
        $table->string('token', 128);
        $table->string('ip_address', 256);
        $table->rememberToken();
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
        Schema::dropIfExists('admin_users');
    }
};
