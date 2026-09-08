<?php

namespace Tests\Feature\Category\Admin;

use App\Enums\Status;
use App\Features\Category\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListCategoryTest extends TestCase{
  use RefreshDatabase;

  public function test_it_filters_and_paginates_category_trees(): void{
    $parent = $this->createCategory('Electronics', Status::ENABLED, 0, 0, 2);
    $child = $this->createCategory('Phones', Status::ENABLED, $parent->id, 1, 1);
    $this->createCategory('Archived', Status::ARCHIVED, 0, 0, 3);

    $response = $this->getJson('/admin/category/list?title=Electro&status=enabled');

    $response
      ->assertOk()
      ->assertJsonCount(1, 'data')
      ->assertJsonPath('data.0.id', $parent->id)
      ->assertJsonPath('data.0.children.0.id', $child->id)
      ->assertJsonPath('meta.current_page', 1)
      ->assertJsonPath('meta.per_page', 50)
      ->assertJsonPath('meta.total', 1);
  }

  private function createCategory(
    string $title,
    Status $status,
    int $parentId,
    int $depth,
    int $sortOrder,
  ): Category{
    $category = Category::query()->create([
      'top' => $depth === 0,
      'status' => $status,
      'image' => null,
      'slug' => str($title)->slug()->toString(),
      'views' => 0,
      'parent_id' => $parentId,
      'depth' => $depth,
      'sort_order' => $sortOrder,
    ]);
    $category->description()->create([
      'title' => $title,
      'description' => $title.' description',
      'meta_title' => $title,
      'meta_description' => $title.' meta description',
    ]);

    return $category;
  }
}
