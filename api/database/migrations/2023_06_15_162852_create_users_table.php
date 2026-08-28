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
      Schema::create('users', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('company')->nullable();
        $table->string('phone', 256)->nullable();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->string('facebook_id',256)->nullable();
        $table->longText('facebook_access_token')->nullable();
        $table->string('google_id',256)->nullable();
        $table->longText('google_access_token')->nullable();
        $table->string('country');
        $table->string('city');
        $table->string('address');
        $table->integer('status')->default(1);
        $table->integer('wholesale')->default(0);
        $table->integer('wholesale_profile')->default(0);
        $table->decimal('total_sum',8,2)->default(0);
        $table->rememberToken();
        $table->timestamps();
      });

      Schema::create('password_reset_tokens', function (Blueprint $table) {
        $table->string('email')->primary();
        $table->string('token');
        $table->timestamp('created_at')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
