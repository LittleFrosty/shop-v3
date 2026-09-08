<?php

namespace Tests\Feature\Category\Admin;

use App\Enums\Status;
use App\Features\Category\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase{
  use RefreshDatabase;

  public function test_it_deletes_a_category_tree_and_dependent_rows(): void{
    $parent = $this->createCategory('parent', 0, 0);
    $child = $this->createCategory('child', $parent->id, 1);

    DB::table('product_to_category')->insert([
      'product_id' => 999,
      'category_id' => $child->id,
    ]);

    $this->deleteJson('/admin/category/'.$parent->id.'/delete')
      ->assertNoContent();

    $this->assertDatabaseMissing('category', ['id' => $parent->id]);
    $this->assertDatabaseMissing('category', ['id' => $child->id]);
    $this->assertDatabaseMissing('category_description', ['category_id' => $parent->id]);
    $this->assertDatabaseMissing('category_description', ['category_id' => $child->id]);
    $this->assertDatabaseMissing('product_to_category', ['category_id' => $child->id]);
  }

  public function test_it_rejects_an_unknown_category(): void{
    $this->deleteJson('/admin/category/999999/delete')
      ->assertUnprocessable()
      ->assertJsonValidationErrors(['id']);
  }

  private function createCategory(string $slug, int $parentId, int $depth): Category{
    $category = Category::query()->create([
      'top' => $depth === 0,
      'status' => Status::ENABLED,
      'image' => $slug.'.jpg',
      'slug' => $slug,
      'views' => 0,
      'parent_id' => $parentId,
      'depth' => $depth,
      'sort_order' => 1,
    ]);
    $category->description()->create([
      'title' => ucfirst($slug),
      'description' => ucfirst($slug).' description',
      'meta_title' => ucfirst($slug),
      'meta_description' => ucfirst($slug).' meta description',
    ]);

    return $category;
  }
}
