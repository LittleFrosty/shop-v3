<?php

namespace Tests\Feature\Category\Admin;

use App\Enums\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreCategoryTest extends TestCase{
    use RefreshDatabase;

    public function test_it_stores_a_category_with_description(): void{
      $payload = [
        'top'               => true,
        'status'            => Status::ENABLED->value,
        'image'             => 'categories/demo.jpg',
        'slug'              => 'electronics',
        'parent_id'         => 0,
        'depth'             => 0,
        'sort_order'        => 1,
        'title'             => 'Electronics',
        'description'       => 'All electronics',
        'meta_title'        => 'Electronics',
        'meta_description'  => 'Shop electronics',
      ];

      $response = $this->postJson('/admin/category/store', $payload);

      $response->assertSuccessful();

      $this->assertDatabaseHas('category', [
        'slug' => 'electronics',
        'parent_id' => 0,
        'depth' => 0,
        'sort_order' => 1,
      ]);

      $this->assertDatabaseHas('category_description', [
        'title' => 'Electronics',
        'description' => 'All electronics',
        'meta_title' => 'Electronics',
        'meta_description' => 'Shop electronics',
      ]);
    }
}
