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
      Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('title', 256);
        $table->longText('description');
        $table->longText('about_us')->nullable();
        $table->string('phone', 256);
        $table->string('website_name', 256);
        $table->string('website_company', 256);
        $table->string('email_address', 256);
        $table->string('logo', 256);
        $table->string('default_image', 256);
        $table->string('favicon', 256);
        $table->string('primary_color', 256)->nullable();
        $table->string('secondary_color', 256)->nullable();
        $table->integer('product_height')->default(0);
        $table->string('product_order_by', 256)->default('id');
        $table->integer('products_per_page')->default(48);
        $table->string('watermark',256)->nullable();
        $table->integer('use_watermark')->default(0);
        $table->integer('disable_right_click')->default(0);
        $table->longText('instagram')->nullable();
        $table->longText('facebook')->nullable();
        $table->longText('tiktok')->nullable();
        $table->longText('youtube')->nullable();
        $table->longText('linkedin')->nullable();
        $table->longText('twitter')->nullable();
        $table->string('twitter_handle', 256)->nullable();
        $table->longText('address')->nullable();
        $table->integer('display_currency')->default(1);
        $table->longText('google_analytics')->nullable();
        $table->longText("facebook_pixel")->nullable();
        $table->longText('google_tagmanager')->nullable();
        $table->longText("ga4_property_id")->nullable();
        $table->longText('google_maps')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
