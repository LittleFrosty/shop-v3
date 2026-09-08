<?php

namespace Tests\Feature\Category\Admin;

use App\Enums\Status;
use App\Features\Category\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase{
  use RefreshDatabase;

  public function test_it_updates_a_category_and_its_description(): void{
    $category = Category::query()->create([
      'top' => true,
      'status' => Status::ENABLED,
      'image' => 'old.jpg',
      'slug' => 'old-category',
      'views' => 1,
      'parent_id' => 0,
      'depth' => 0,
      'sort_order' => 1,
    ]);
    $category->description()->create([
      'title' => 'Old category',
      'description' => 'Old description',
      'meta_title' => 'Old meta title',
      'meta_description' => 'Old meta description',
    ]);

    $response = $this->patchJson('/admin/category/'.$category->id.'/update', [
      'status' => Status::DRAFT->value,
      'slug' => 'updated-category',
      'sort_order' => 4,
      'title' => 'Updated category',
      'description' => 'Updated description',
    ]);

    $response
      ->assertOk()
      ->assertJsonPath('id', $category->id)
      ->assertJsonPath('title', 'Updated category')
      ->assertJsonPath('status', Status::DRAFT->value)
      ->assertJsonPath('slug', 'updated-category');

    $this->assertDatabaseHas('category', [
      'id' => $category->id,
      'status' => Status::DRAFT->value,
      'slug' => 'updated-category',
      'sort_order' => 4,
    ]);
    $this->assertDatabaseHas('category_description', [
      'category_id' => $category->id,
      'title' => 'Updated category',
      'description' => 'Updated description',
    ]);
  }

  public function test_it_rejects_an_unknown_category(): void{
    $this->patchJson('/admin/category/999999/update', [
      'title' => 'Missing',
    ])
      ->assertUnprocessable()
      ->assertJsonValidationErrors(['id']);
  }
}
