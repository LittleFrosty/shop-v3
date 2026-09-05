<?php

namespace Tests\Feature\Category\Admin;

use App\Enums\Status;
use App\Features\Category\Models\Category;
use Tests\TestCase;

class ShowCategoryTest extends TestCase{
  public function test_it_returns_the_category_json(): void{
    $category = Category::create([
        'top'        => true,
        'status'     => Status::ENABLED,
        'image'      => 'categories/demo.jpg',
        'slug'       => 'electronics',
        'parent_id'  => 0,
        'depth'      => 0,
        'views'      => 5,
        'sort_order' => 1,
    ]);

    $category->description()->create([
        'title'            => 'Electronics',
        'description'      => 'All electronics',
        'meta_title'       => 'Electronics',
        'meta_description' => 'Shop electronics',
    ]);

    $response = $this->getJson('/admin/category/'.$category->id);

    $response->assertOk();
    $response->assertJsonPath('id', $category->id);
    $response->assertJsonPath('title', 'Electronics');
    $response->assertJsonPath('description', 'All electronics');
    $response->assertJsonPath('meta_title', 'Electronics');
    $response->assertJsonPath('meta_description', 'Shop electronics');
    $response->assertJsonPath('slug', 'electronics');
    $response->assertJsonPath('status', Status::ENABLED->value);
    $response->assertJsonPath('image', 'categories/demo.jpg');
    $response->assertJsonPath('parent_id', 0);
    $response->assertJsonPath('depth', 0);
    $response->assertJsonPath('views', 5);
    $response->assertJsonPath('sort_order', 1);
  }

  public function test_it_rejects_a_missing_category(): void{
    $response = $this->getJson('/admin/category/999999');

    $response->assertUnprocessable();
    $response->assertJsonValidationErrors(['id']);
  }
}
