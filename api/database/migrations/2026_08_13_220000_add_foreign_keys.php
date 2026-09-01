<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->foreign('attribute_id')->references('id')->on('attribute')->cascadeOnDelete();
        });

        Schema::table('option_values', function (Blueprint $table) {
            $table->foreign('option_id')->references('id')->on('options')->cascadeOnDelete();
        });

        Schema::table('product', function (Blueprint $table) {
            $table->foreign('brand_id')->references('id')->on('brand')->nullOnDelete();
        });

        Schema::table('product_description', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product')->cascadeOnDelete();
        });

        Schema::table('product_to_category', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product')->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('category')->cascadeOnDelete();
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product')->cascadeOnDelete();
        });

        Schema::table('product_options', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product')->cascadeOnDelete();
            $table->foreign('option_id')->references('id')->on('options')->cascadeOnDelete();
            $table->foreign('option_value_id')->references('id')->on('option_values')->cascadeOnDelete();
        });

        Schema::table('product_attributes', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product')->cascadeOnDelete();
            $table->foreign('attribute_id')->references('id')->on('attribute')->cascadeOnDelete();
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->cascadeOnDelete();
        });

        Schema::table('category', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('category')->nullOnDelete();
        });

        Schema::table('category_description', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('category')->cascadeOnDelete();
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });

        Schema::table('cart_products', function (Blueprint $table) {
            $table->foreign('cart_id')->references('id')->on('cart')->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('product')->restrictOnDelete();
        });

        Schema::table('cart_notes', function (Blueprint $table) {
            $table->foreign('cart_id')->references('id')->on('cart')->cascadeOnDelete();
        });

        Schema::table('cart_invoices', function (Blueprint $table) {
            $table->foreign('order_cart_id')->references('id')->on('cart')->cascadeOnDelete();
        });

        Schema::table('return_order', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('cart')->cascadeOnDelete();
        });

        Schema::table('email_history', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('cart')->nullOnDelete();
        });

        Schema::table('related_products', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product')->cascadeOnDelete();
            $table->foreign('related_id')->references('id')->on('product')->cascadeOnDelete();
        });

        Schema::table('product_review', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('post_categories')->nullOnDelete();
        });

        Schema::table('posts_content', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
        });

        Schema::table('posts_content_components', function (Blueprint $table) {
            $table->foreign('post_content_id')->references('id')->on('posts_content')->cascadeOnDelete();
        });

        Schema::table('room_messages', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('rooms')->cascadeOnDelete();
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        $foreigns = [
            'attribute_values' => ['attribute_id'],
            'option_values' => ['option_id'],
            'product' => ['brand_id'],
            'product_description' => ['product_id'],
            'product_to_category' => ['product_id', 'category_id'],
            'product_images' => ['product_id'],
            'product_options' => ['product_id', 'option_id', 'option_value_id'],
            'product_attributes' => ['product_id', 'attribute_id', 'attribute_value_id'],
            'category' => ['parent_id'],
            'category_description' => ['category_id'],
            'cart' => ['user_id'],
            'cart_products' => ['cart_id', 'product_id'],
            'cart_notes' => ['cart_id'],
            'cart_invoices' => ['order_cart_id'],
            'return_order' => ['order_id'],
            'email_history' => ['order_id'],
            'related_products' => ['product_id', 'related_id'],
            'product_review' => ['product_id', 'user_id'],
            'posts' => ['category_id'],
            'posts_content' => ['post_id'],
            'posts_content_components' => ['post_content_id'],
            'room_messages' => ['room_id'],
            'sessions' => ['user_id'],
        ];

        foreach ($foreigns as $table => $columns) {
            Schema::table($table, function (Blueprint $blueprint) use ($columns) {
                foreach ($columns as $column) {
                    $blueprint->dropForeign([$column]);
                }
            });
        }
    }
};
