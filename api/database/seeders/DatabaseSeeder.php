<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Features\Category\Admin\Actions\StoreCategoryAction;
use App\Features\Category\Admin\DTOs\StoreCategoryDTO;
use App\Features\Category\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
  public function run(): void{
    $categories = json_decode(
      file_get_contents(database_path('seeders/categories.json')),
      true,
      512,
      JSON_THROW_ON_ERROR,
    );

    foreach($categories as $category){
      $this->storeCategory($category, 0, 0);
    }
  }

  private function storeCategory(array $category, int $parentId, int $depth): void{
    $payload = StoreCategoryDTO::fromArray([
      'top'               => $parentId === 0,
      'status'            => Status::ENABLED->value,
      'image'             => $category['image'],
      'slug'              => $category['slug'],
      'parent_id'         => $parentId,
      'depth'             => $depth,
      'sort_order'        => $category['sort_order'],
      'title'             => $category['title'],
      'description'       => $category['description'],
      'meta_title'        => $category['meta_title'],
      'meta_description'  => $category['meta_description'],
    ]);

    app(StoreCategoryAction::class)->handle($payload);

    $storedCategory = Category::query()
      ->where('slug', $category['slug'])
      ->latest('id')
      ->firstOrFail();

    foreach($category['children'] ?? [] as $child){
      $this->storeCategory($child, $storedCategory->id, $depth + 1);
    }
  }
}
